<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewRequest extends Notification implements ShouldQueue
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

    public function toArray($notifiable)
    {
        $date = new \Carbon\Carbon($this->request->date);

        return [
            'request_id' => $this->request->id,
            'n_message' => $this->request->auditorium->name . " requisitado para o dia " .
                $date->format('d/m'),
            'n_url' => route('requests.show', ['id' => $this->request->id, 'from' => 'notification']),
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'data' => $this->toArray($notifiable),
        ]);
    }

    public function toMail($notifiable)
    {
        $url = route('requests.show', ['id' => $this->request->id, 'from' => 'notification']);

        return (new MailMessage)
            ->greeting('Olá!')
            ->line('Um usuário requisitou o '.$this->request->auditorium->name.'.')
            ->action('Ver pedido', $url)
            ->line('Obrigado por utilizar nosso sistema!');
    }
}
