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
			$message = \App\Message::find($event->message_id);

			foreach ($message->call->members as $member) {
				if ($member->id != $message->user_id) {
					$send = true;
					foreach ($member->unreadNotifications as $notification) {
						if ($notification->type == "App\Notifications\NewMessage" &&
							$notification->data['call_id'] == $message->call_id) {
							$send = false;
							break;
						}
					}
				
					if ($send) {
					 	$member->notify(new NewMessage($message));
					}
				}
			}
    }
}
