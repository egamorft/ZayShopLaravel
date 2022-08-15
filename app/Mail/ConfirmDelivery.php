<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmDelivery extends Mailable
{
    use Queueable;
    use SerializesModels;
    public $order_code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_code)
    {
        $this->order_code = $order_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirmation.delivery');
    }
}
