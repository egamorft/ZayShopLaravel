<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmResetPassword extends Mailable
{
    use Queueable;
    use SerializesModels;
    public $verify_code;
    public $email_to;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verify_code, $email_to)
    {
        $this->verify_code = $verify_code;
        $this->email_to = $email_to;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirmation.resetPassword');
    }
}
