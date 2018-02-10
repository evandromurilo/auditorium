<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notification;

class NotificationController extends Controller
{
    public function unreadNotifications()
    {
        return Auth::user()->unreadNotifications;
    }

    public function markAsRead(Request $request)
    {
        $notification = Auth::user()->notifications()->findOrFail($request->segment(2));

        if ($request->read) {
            $notification->markAsRead();
            event(new \App\Events\NotificationRead(Auth::user()));
        }

        return $notification;
    }

    public function markAllAsRead(Request $request)
    {
        Auth::user()->unreadNotifications->markAsRead();
        event(new \App\Events\NotificationRead(Auth::user()));

        return redirect()->route('home');
    }
}
