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
			];
		}

		public function toBroadcast($notifiable) {
			return new BroadcastMessage([
				'request_id' => $this->request->id,
				'auditorium_name' => $this->request->auditorium->name,
			]);
		}
}
