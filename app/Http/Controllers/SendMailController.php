<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmAccount;
use App\Mail\ConfirmDelivery;
use App\Mail\ConfirmOrder;
use App\Order;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SendMailController extends Controller
{
    public function confirm_order(Request $request){
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toFormattedDateString();
        $email_to = $data['shipping_email'];
        Mail::to($email_to)->send(new ConfirmOrder($data, $now));
    }

    public function confirm_delivery(Request $request){
        $data = $request->all();
        $order_id = $data['order_id'];
        $get_order = Order::where('order_id', $order_id)->first();
        $order_code = $get_order->order_code;
        $shipping_id = $get_order->shipping_id;
        $shipping = Order::with('shipping')->where('shipping_id', $shipping_id)->first();
        $email_to = $shipping->shipping->shipping_email;
        Mail::to($email_to)->send(new ConfirmDelivery($order_code));
    }

    public function confirm_account(Request $request){
        $data = $request->all();
        $email_to = $data['account_email'];
        $name = $data['account_name'];
        $phone = $data['account_phone'];
        $verify_code = $data['verify_code'];
        Mail::to($email_to)->send(new ConfirmAccount($verify_code, $name, $phone, $email_to));
        Session::put('message', 'Email vertification has sent to you, check your email to login');
        return Redirect::to('/register');
    }
}
