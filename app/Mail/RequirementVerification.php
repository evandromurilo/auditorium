<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Requirement;

class RequirementVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $requirement;
    public $verification;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Requirement $requirement)
    {
        $this->subject("Confirmação de presença em evento");

        $this->requirement = $requirement;

        $this->verification = new \App\RequirementVerification;
        $this->verification->hash = md5(rand(0,1000));
        $this->verification->requirement_id = $requirement->id;
        $this->verification->status = 0;
        $this->verification->save();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.requirement_verification');
    }
}
