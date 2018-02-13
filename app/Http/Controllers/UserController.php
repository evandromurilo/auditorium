<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('user.index')->with('users', User::all());
    }

    public function show(Request $request, User $user)
    {
        $requests = \App\Request::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('user.show')->with([
            'user' => $user,
            'requests' => $requests
        ]);
    }

    public function edit(Request $request, User $user)
    {
        if (!$user->id == Auth::user()->id) {
            $this->authorize('edit', \App\Request::class);
        }

        return view('user.edit')->with('user', $user);
    }

    public function activate(Request $request, User $user)
    {
        $this->authorize('edit', \App\User::class);

        $user->active = true;
        $user->save();

        return route('users.index');
    }

    public function deactivate(Request $request, User $user)
    {
        $this->authorize('edit', \App\User::class);

        $user->active = false;
        $user->save();

        return route('users.index');
    }

    public function update(Request $request, User $user)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'color' => [
                'required',
                'string',
                'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/',
            ],
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'password.min' => 'O campo senha deve ter pelo menos 6 caracteres.',
            'password.confirmed' => 'A confirmação não bate.',
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O campo nome deve ter até 255 caracteres.',
            'color.required' => 'O campo cor é obrigatório.',
            'color.regex' => 'Formato inválido no campo cor.',
        ]);

        $user->name = $request->name;
        $user->color = $request->color;
        $user->cel = $request->cel;
        $user->description = $request->description;
        $user->receives_mail = $request->has('receives-mail')? true : false;

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if (Auth::user()->isAn('admin')) {
            $user->retract('admin');
            $user->retract('secre');
            $user->retract('coord');

            $user->assign($request->role);
        }

        $user->save();

        return redirect()->route('users.show', $user->id);
    }
}
