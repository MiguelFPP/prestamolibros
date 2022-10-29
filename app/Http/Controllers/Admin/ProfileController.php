<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('admin.profile.index', compact('user'));
    }

    public function update(UpdateRequest $request)
    {
        $data = $request->validated();

        $user = User::find(auth()->user()->id);
        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->email = $data['email'];
        $user->save();

        return redirect()->route('profile.index')->with('info', 'Perfil actualizado con éxito');
    }
}
