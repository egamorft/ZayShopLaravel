<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmDelivery;
use App\Mail\ConfirmOrder;
use App\Order;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

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
}
