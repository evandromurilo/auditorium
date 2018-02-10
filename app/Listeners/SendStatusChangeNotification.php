<?php

namespace App\Listeners;

use App\Events\RequestStatusChanged;
use App\Notifications\RequestResolved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendStatusChangeNotification implements ShouldQueue
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
     * @param  RequestStatusChanged  $event
     * @return void
     */
    public function handle(RequestStatusChanged $event)
    {
        if ($event->request->user->id == $event->user_agent->id) {
            return;
        }

        $send = true;

        $user = $event->request->user;
        $notifications =  $user->unreadNotifications()
            ->where('type', 'App\Notifications\RequestResolved')
            ->get();

        foreach ($notifications as $notification) {
            if ($notification->data['request_id'] == $event->request->id) {
                $send = false;
                break;
            }
        }

        if ($send) {
            $user->notify(new RequestResolved($event->request));
        }
    }
}
