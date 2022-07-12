<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmAccount extends Mailable
{
    use Queueable, SerializesModels;
    public $verify_code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verify_code)
    {
        $this->verify_code = $verify_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirmation.verifyAccount');
    }
}
