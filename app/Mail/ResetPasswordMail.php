<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetUrl;
    public $userName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($resetUrl, $userName)
    {
        $this->resetUrl = $resetUrl;
        $this->userName = $userName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
    return $this->subject('Reset Password - Academic Creativity Week')
                    ->view('emails.reset-password');
    }
}
