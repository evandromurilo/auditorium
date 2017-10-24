<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CallCreated {
    use Dispatchable, InteractsWithSockets, SerializesModels;

		public $call;
		public $creator;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Call $call, \App\User $creator) {
        $this->call = $call;
				$this->creator = $creator;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
