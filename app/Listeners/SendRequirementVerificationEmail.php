<?php

namespace App\Listeners;

use App\Events\RequestStatusChanged;
use App\Notifications\NewRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\RequirementVerification;

class SendRequirementVerificationEmail implements ShouldQueue
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

        if (!is_null($dean_requirement) &&
            is_null(RequirementVerification::where('requirement_id', $dean_requirement->id)
            ->first())) {
            Mail::to(env('MAIL_DEAN'))
                ->send(new \App\Mail\RequirementVerification($dean_requirement));
        }

        $chaplain_requirement = $event->request->requirements()->where('name', 'Capelão')->first();

        if (!is_null($chaplain_requirement) &&
            is_null(RequirementVerification::where('requirement_id', $chaplain_requirement->id)
            ->first())) {
            Mail::to(env('MAIL_CHAPLAIN'))
                ->send(new \App\Mail\RequirementVerification($chaplain_requirement));
        }
    }
}
