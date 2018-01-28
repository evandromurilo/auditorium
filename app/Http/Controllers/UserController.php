<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	public function index(Request $request) {
		return view('user.index')->with('users', User::all());
	}

	public function show(Request $request) {
		$user = User::find($request->segment(2));
		$requests = \App\Request::where('user_id', $user->id)
			->orderBy('date', 'desc')
			->paginate(10);

		return view('user.show')->with(['user' => $user,
			'requests' => $requests]);
	}

	public function edit(Request $request) {
		$user = User::find($request->segment(2));

		if (!$user->id == Auth::user()->id) {
			$this->authorize('edit', \App\Request::class);
		}

		return view('user.edit')->with('user', $user);
	}

  public function activate(Request $request, $id) {
			$this->authorize('edit', \App\User::class);

      $user = User::findOrFail($id);
      $user->active = true;
      $user->save();

      return route('users.index');
  }

  public function deactivate(Request $request, $id) {
			$this->authorize('edit', \App\User::class);

      $user = User::findOrFail($id);
      $user->active = false;
      $user->save();

      return route('users.index');
  }

	public function update(Request $request) {
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

		$user = User::find($request->segment(2));

		$user->name = $request->name;
		$user->color = $request->color;
		$user->cel = $request->cel;
		$user->description = $request->description;

    if (!empty($request->password)) {
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

	public function calls(Request $request) {
		$user_id = $request->segment(2);

		if (Auth::user()->isAn('admin') || Auth::id() == $user_id) {
			return Auth::user()->calls;
		}
		else {
			abort(403);
		}
	}
}
