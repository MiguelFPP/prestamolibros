<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Notifications\ClientNotification;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.create')->only('create');
        $this->middleware('can:users.store')->only('store');
        $this->middleware('can:users.edit')->only('edit');
        $this->middleware('can:users.update')->only('update');
        $this->middleware('can:users.destroy')->only('destroy');
    }

    /**
     * If the user is an admin, show all users, otherwise show all users except admins
     *
     * @return A view with the users
     */
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $users = User::where('id', '!=', auth()->id())
                ->with('roles:name')
                ->orderBy('id', 'desc')
                ->paginate(6);
        } else {
            $users = User::where('id', '!=', auth()->id())
                ->with('roles:name')
                ->whereHas('roles', function ($query) {
                    $query->where('name', '!=', 'admin');
                })
                ->orderBy('id', 'desc')
                ->paginate(6);
        }

        return view('admin.users.index', compact('users'));
    }


    /**
     * If the user is an admin, show all roles. If the user is not an admin, show all roles except
     * admin
     *
     * @return A view with the roles
     */
    public function create()
    {
        if (auth()->user()->hasRole('admin')) {
            $roles = \Spatie\Permission\Models\Role::all();
        } else {
            $roles = \Spatie\Permission\Models\Role::where('name', '!=', 'admin')->get();
        }
        return view('admin.users.create', compact('roles'));
    }

    /**
     * It creates a new user and assigns a role to it.
     *
     * @param UserRequest request The incoming request.
     *
     * @return A redirect to the route admin.users.index with a flash message.
     */
    public function store(UserRequest $request)
    {
        if ($request->role != 'client') {
            $user = User::create([
                'identification' => $request->identification,
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'password' => bcrypt($request->identification),
            ]);
        } else {
            $user = User::create([
                'identification' => $request->identification,
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
            ]);

            $name = $user->name . ' ' . $user->surname;
            $user->notify(new ClientNotification($name));
        }
        $user->assignRole($request->get('role'));
        if ($request->role != 'client') {
            $user->sendEmailVerificationNotification();
        }

        return redirect()->route('admin.users.index')->with('info', 'Usuario creado con éxito');
    }

    /**
     * It returns a view that contains a form to edit a user
     *
     * @param User user This is the user we're editing.
     *
     * @return The view is being returned.
     */
    public function edit(User $user)
    {
        if (auth()->user()->hasRole('admin')) {
            $roles = \Spatie\Permission\Models\Role::all();
        } else {
            $roles = \Spatie\Permission\Models\Role::where('name', '!=', 'admin')->get();
        }

        $userRoles = $user->roles->pluck('name')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * If the user's role is changed, the user's roles are updated, and if the user's role is not
     * client, the user's password is updated and the user is sent an email verification notification
     *
     * @param UserUpdateRequest request The incoming request.
     * @param User user The user model instance
     *
     * @return The user is being updated with the request data.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        if ($user->role != $request->role) {
            $user->syncRoles($request->get('role'));
            if ($request->role != 'client' && !$user->hasVerifiedEmail()) {
                $user->update([
                    'password' => bcrypt($request->identification),
                ]);
                $user->sendEmailVerificationNotification();
            } elseif ($request->role == 'client') {
                $user->update([
                    'password' => null,
                    'email_verified_at' => null,
                ]);
            }
        }
        $user->update($request->all());
        return back()->with('info', 'Usuario actualizado con éxito');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('info', 'Usuario eliminado con éxito');
    }
}
