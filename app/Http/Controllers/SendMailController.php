<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class SendMailController extends Controller
{
    public function confirm_order(Request $request){
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toFormattedDateString();
        $email_to = $data['shipping_email'];
        Mail::to($email_to)->send(new ConfirmOrder($data));
    }
}
