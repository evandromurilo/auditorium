<?php

namespace App\Listeners;

use App\Events\CallCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SetCallMembersPermissions
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
     * @param  CallCreated  $event
     * @return void
     */
    public function handle(CallCreated $event)
    {
			foreach ($event->call->members as $member) {
				$member->allow('see', $event->call);
			}
    }
}
