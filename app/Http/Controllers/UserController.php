<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller {
	public function show(Request $request) {
		$user = User::find($request->segment(2));
		$requests = \App\Request::where('user_id', $user->id)->get();

		return view('user.show')->with(['user' => $user,
			'requests' => $requests]);
	}
}
