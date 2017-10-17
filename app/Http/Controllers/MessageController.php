<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Call;
use \App\Message;
use \App\CallMember;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller {
	public function store(Request $request) {
		$message = new Message;

		$message->call_id = $request->call_id;
		$message->user_id = Auth::id();
		$message->body = $request->body;

		$message->save();

		return redirect()->route('calls.show', $message->call_id);
	}
}
