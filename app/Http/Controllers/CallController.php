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

		$call_member = new CallMember;
		$call_member->user_id = $request->user_id;
		$call_member->call_id = $call->id;
		$call_member->save();

		$call_member = new CallMember;
		$call_member->user_id = Auth::id();
		$call_member->call_id = $call->id;
		$call_member->save();

		return redirect()->route('calls.show', $call->id);
	}
}
