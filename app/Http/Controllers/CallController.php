<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \App\Call;
use \App\CallMember;

class CallController extends Controller {
	public function show(Request $request) {
		$call = Call::find($request->segment(2));

		return view('call.show')->with('call', $call);
	}

	public function store(Request $request) {
		$call = new Call;
		$call->title = $request->title;
		$call->save();

		$call->members()->attach($request->user_id);
		$call->members()->attach(Auth::id());

		return redirect()->route('calls.show', $call->id);
	}
}
