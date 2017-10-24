<?php

namespace App\Listeners;

use App\Events\CallCreated;
use App\User;
use App\Notifications\NewCall;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewCallNotification
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
     * @param  MessageCreated  $event
     * @return void
     */
    public function handle(CallCreated $event)
    {
			foreach ($event->call->members as $member) {
				if ($member->id != $event->creator->id) {
					 	$member->notify(new NewCall($event->call));
				}
			}
    }
}
