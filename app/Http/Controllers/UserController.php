<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller {
	public function show(Request $request) {
		$user = User::find($request->segment(2));

		return view('user.show')->with('user', $user);
	}
}
