<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewCall extends Notification implements ShouldQueue
{
    use Queueable;

		public $call;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(\App\Call $call) {
        $this->call = $call;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['database', 'broadcast'];
    }

		public function toArray($notifiable) {
			return [
				'call_id' => $this->call->id,
				'call_title' => $this->call->title,
				'n_message' => "Você foi inserido em uma nova chamada.",
			  'n_url' => route('calls.index', ['id' => $this->call->id, 'from' => 'notification']),
				'call' => $this->call,
			];
		}

		public function toBroadcast($notifiable) {
			return new BroadcastMessage([
				'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
				'data' => $this->toArray($notifiable),
			]);
		}
}
