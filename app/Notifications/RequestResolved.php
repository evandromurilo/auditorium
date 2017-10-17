<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class RequestResolved extends Notification
{
    use Queueable;

		public $request;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(\App\Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

		public function toArray($notifiable) {
			return [
				'request_id' => $this->request->id,
				'auditorium_name' => $this->request->auditorium->name,
			  'message' => "Sua requisição do ".$this->request->auditorium->name." mudou de status.",
			  'url' => route('requests.show', ['id' => $this->request->id, 'from' => 'notification']),
			];
		}

		public function toBroadcast($notifiable) {
			return new BroadcastMessage([
				'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
				'data' => $this->toArray($notifiable),
			]);
		}
}
