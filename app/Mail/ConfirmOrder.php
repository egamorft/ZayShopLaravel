<?php

namespace App\Mail;

use App\Shipping;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmOrder extends Mailable
{
    use Queueable;
    use SerializesModels;
    public $shipping;
    public $now;
    public $fee;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($shipping, $now, $fee)
    {
        $this->shipping = $shipping;
        $this->now = $now;
        $this->fee = $fee;
        // $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirmation.shipping');
    }
}
