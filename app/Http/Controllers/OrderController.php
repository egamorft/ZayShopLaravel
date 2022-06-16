<?php

namespace App\Http\Controllers;

use App\Account;
use App\Order;
use App\OrderDetails;
use App\Shipping;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show_order(){
        $order = Order::orderBy('created_at', 'DESC')->get();
        return view('admin.order.show_order')->with(compact('order'));
    }

    public function view_order($order_code){
        // $order_details = OrderDetails::where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code)->get();
        foreach ($order as $key => $od) {
            $account_id = $od->account_id;
            $shipping_id = $od->shipping_id;
        }
        $account = Account::where('account_id', $account_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();

        $order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();
        return view('admin.order.view_order')->with(compact('order_details', 'account', 'shipping'));
    }
}
