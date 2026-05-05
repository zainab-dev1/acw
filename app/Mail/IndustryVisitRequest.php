<?php

namespace App\Mail;

use App\Models\VisitRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class IndustryVisitRequest extends Mailable
{
    use Queueable, SerializesModels;

    protected $visit_request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(VisitRequest $visit_request)
    {
        $this->visit_request = $visit_request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.industryvisit')->with('visit_requests',$this->visit_request);
    }
}
