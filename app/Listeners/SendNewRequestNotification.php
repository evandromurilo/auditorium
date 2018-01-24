<?php

namespace App\Listeners;

use App\Events\RequestCreated;
use App\Notifications\NewRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewRequestNotification implements ShouldQueue
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
     * @param  RequestCreated  $event
     * @return void
     */
    public function handle(RequestCreated $event)
    {
			$users = \App\User::whereIs('secre')->get();

			foreach ($users as $user) {
				$user->notify(new NewRequest($event->request));
			}
    }
}
