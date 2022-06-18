<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->with('roles:name')->orderBy('id', 'desc')->paginate(6);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = \Spatie\Permission\Models\Role::all();
        return view('admin.users.create', compact('roles'));
    }

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
        }

        $user->assignRole($request->get('role'));
        $user->sendEmailVerificationNotification();

        return redirect()->route('admin.users.index')->with('info', 'Usuario creado con éxito');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        return back()->with('info', 'Usuario actualizado con éxito');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('info', 'Usuario eliminado con éxito');
    }
}
