<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewMessage extends Notification
{
    use Queueable;

		public $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(\App\Message $message) {
        $this->message = $message;
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
				'message_id' => $this->message->id,
				'user_id' => $this->message->user->id,
				'user_name' => $this->message->user->name,
				'call_title' => $this->message->call->title,
				'call_id' => $this->message->call_id,
				'n_message' => "Você recebeu uma nova mensagem de ".$this->message->user->name.".",
			  'n_url' => route('calls.index', ['id' => $this->message->call_id, 'from' => 'notification']),
			];
		}

		public function toBroadcast($notifiable) {
			return new BroadcastMessage([
				'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
				'data' => $this->toArray($notifiable),
			]);
		}
}
