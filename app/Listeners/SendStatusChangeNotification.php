<?php

namespace App\Listeners;

use App\Events\RequestStatusChanged;
use App\Notifications\RequestResolved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendStatusChangeNotification
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
        \Log::info('notification', ['request' => $event->request]);

				$send = true;

				foreach ($event->request->user->unreadNotifications as $notification) {
					if ($notification->type == "App\Notifications\RequestResolved" &&
						$notification->data['request_id'] == $event->request->id) {
						$send = false;
						break;
					}
				}

				if ($send) {
					$event->request->user->notify(new RequestResolved($event->request));
				}
    }
}
