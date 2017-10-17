<?php

namespace App\Listeners;

use App\Events\MessageCreated;
use App\User;
use App\Notifications\NewMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewMessageNotification
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
    public function handle(MessageCreated $event)
    {
			foreach ($event->message->call->members as $member) {
				if ($member->id != $event->message->user_id) {
					User::find($member->id)->notify(new NewMessage($event->message));
				}
			}
    }
}
