<?php

namespace App\Mail;

use App\Models\EventResult;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CertificateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $survey_result;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(EventResult $survey_result)
    {
        $this->survey_result = $survey_result;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.certificate');
    }
}
