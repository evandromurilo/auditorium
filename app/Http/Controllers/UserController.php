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

	public function update(Request $request) {
		$user = User::find($request->segment(2));

		$user->name = $request->name;
		$user->color = $request->color;
		$user->email = $request->email;
		$user->cel = $request->cel;
		$user->description = $request->description;

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
