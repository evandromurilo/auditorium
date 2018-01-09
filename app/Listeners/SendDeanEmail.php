<?php

namespace App\Listeners;

use App\Events\RequestStatusChanged;
use App\Notifications\NewRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\DeanRequired;
use Illuminate\Support\Facades\Mail;

class SendDeanEmail
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
    public function handle(RequestStatusChanged $event)
    {
      if ($event->request->status != 2) return;

      $dean_requirement = $event->request->requirements()->where('name', 'Reitor')->first();

      if (!is_null($dean_requirement)) {
        Mail::to(env('MAIL_DEAN'))->send(new DeanRequired($dean_requirement));
      }
    }
}
