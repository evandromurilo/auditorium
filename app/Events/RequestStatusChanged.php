<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RequestStatusChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $request;
    public $user_agent;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Request $request, \App\User $user_agent)
    {
        $this->request = $request;
        $this->user_agent = $user_agent;
    }
}
