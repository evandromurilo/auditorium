<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller {
	public function unreadNotifications() {
		return Auth::user()->unreadNotifications;
	}

	public function markNewMessageAsRead(Request $request) {
		$call_id = $request->segment(3);

		foreach (Auth::user()->unreadNotifications as $notification) {
			if ($notification->type == "App\Notifications\NewMessage" &&
				$notification->data['call_id']	== $call_id) {
				$notification->markAsRead();

				event(new \App\Events\NotificationRead(Auth::user()));
			}
		}
	}
}
