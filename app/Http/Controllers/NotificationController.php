<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller {
	public function unreadNotifications() {
		return Auth::user()->unreadNotifications;
	}
}
