<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Call;
use \App\Message;
use \App\CallMember;
use Illuminate\Support\Facades\Auth;
use \App\Helpers\ChatBot;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller {
	public function store(Request $request) {
		$message = new Message;

		$message->call_id = $request->call_id;

		if ($request->body[0] == '\\') {
			$message->user_id = 1;
			$message->body = ChatBot::resolveCommand($request->body);
		} else {
			$message->user_id = Auth::id();
			$message->body = $request->body;
		}

		$message->save();

		event(new \App\Events\MessageCreated($message));

		return redirect()->route('calls.show', $message->call_id);
	}
}
