<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmAccount extends Mailable
{
    use Queueable;
    use SerializesModels;
    public $verify_code;
    public $name;
    public $phone;
    public $email_to;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verify_code, $name, $phone, $email_to)
    {
        $this->verify_code = $verify_code;
        $this->name = $name;
        $this->phone = $phone;
        $this->email_to = $email_to;
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
