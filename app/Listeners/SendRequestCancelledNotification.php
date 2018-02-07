<?php

namespace App\Listeners;

use App\Events\RequestCancelled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRequestCancelledNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RequestCancelled  $event
     * @return void
     */
    public function handle(RequestCancelled $event)
    {
        $users = \App\User::whereIs('secre')->where('active', true)->get();
        $send = true;

        foreach ($users as $user) {
            $notification = $user->unreadNotifications()
                ->where('type', 'App\Notifications\NewRequest')
                ->first();

            if ($notification) {
                $notification->markAsRead();
                event(new \App\Events\NotificationRead($user));
            } else {
                $user->notify(new \App\Notifications\RequestCancelled($event->request));
            }
        }
    }
}
