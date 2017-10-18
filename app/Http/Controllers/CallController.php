<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \App\Call;
use \App\CallMember;

class CallController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	public function show(Request $request) {
		$call = Call::find($request->segment(2));

		$this->authorize('see', $call);

		foreach (Auth::user()->unreadNotifications as $notification) {
			if ($notification->type == "App\Notifications\NewMessage" &&
				$notification->data['call_id']	== $call->id) {
				$notification->markAsRead();
			}
		}

		return view('call.show')->with('call', $call);
	}

	public function store(Request $request) {
		$call = new Call;
		$call->title = $request->title;
		$call->save();

		$call->members()->attach($request->user_id);
		$call->members()->attach(Auth::id());

		foreach ($call->members as $member) {
			$member->allow('see', $call);
		}

		return redirect()->route('calls.show', $call->id);
	}
}
