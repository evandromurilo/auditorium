<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \App\User;
use \App\Call;
use \App\CallMember;
use Bouncer;

class CallController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	public function index(Request $request) {
		return view('call.index')->with('calls', Auth::user()->calls->reverse());
	}

	public function create() {
		return view('call.create')->with('users', User::all());
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

	public function createCall(Request $request) {
			if (sizeof($request->members) == 2) {
				$user_id = User::where('email', $request->members[1]['email'])->first()->id;
				$call = $this->createOneToOneCall($user_id);
			}
			else {
				$call = new Call;
				$call->title = $request->title;
				$call->save();

				foreach ($request->members as $member) {
					$user = User::where('email', $member['email'])->first();
					$call->members()->attach($user->id);
				}
			}

			return $call;
	}

	public function createOneToOneCall($user_id) {
		$call_user = DB::table('call_user as first')
			->join('call_user as second', 'first.call_id', '=', 'second.call_id')
			->where('first.user_id', '=', $user_id)
			->where('second.user_id', '=', Auth::id())
			->first();

		if ($call_user) {
			$call = Call::find($call_user->call_id);
		} else {
			$call = new Call;
			$call->title = User::find($user_id)->name.' e '.Auth::user()->name;
			$call->save();

			$call->members()->attach($user_id);
			$call->members()->attach(Auth::id());
		}

		return $call;
	}

	public function store(Request $request) {
		if ($request->from == "create_call") {
			$call = $this->createCall($request);
		} else {
			$call = $this->createOneToOneCall($request->user_id);
		}

		foreach ($call->members as $member) {
			$member->allow('see', $call);
		}

		if ($request->from == "create_call") {
			return route('calls.show', $call->id);
		} else {
			return redirect()->route('calls.show', $call->id);
		}
	}
}
