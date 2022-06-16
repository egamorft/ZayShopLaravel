<?php

namespace App\Http\Controllers;

use App\Account;
use App\Coupon;
use App\Order;
use App\OrderDetails;
use App\Shipping;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function show_order()
    {
        $order = Order::orderBy('created_at', 'DESC')->get();
        return view('admin.order.show_order')->with(compact('order'));
    }

    public function view_order($order_code)
    {
        // $order_details = OrderDetails::where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code)->get();
        foreach ($order as $key => $od) {
            $account_id = $od->account_id;
            $shipping_id = $od->shipping_id;
        }
        $account = Account::where('account_id', $account_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();
        $details = OrderDetails::with('product')->where('order_code', $order_code)->first();
        $order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();
        foreach ($order_details as $key => $order_d) {
            $product_coupon = $order_d->product_coupon;
        }
        if ($product_coupon != 'no') {
            $coupon = Coupon::where('coupon_code', $product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        } else {
            $coupon_condition = 2;
            $coupon_number = 0;
        }

        return view('admin.order.view_order')->with(compact('details','order_details', 'account', 'shipping', 'coupon_condition', 'coupon_number'));
    }

    public function delete_order($order_code){
        $shipping_id = Order::where('order_code', $order_code)->first();
        Order::where('order_code', $order_code)->delete();
        OrderDetails::where('order_code', $order_code)->delete();
        Shipping::where('shipping_id', $shipping_id->shipping_id)->delete();
        Session::put('message', 'Successfully delete order ' . $order_code);
        return Redirect::to('/order');
    }

    public function print_bill($checkout_code)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_bill_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_bill_convert($checkout_code)
    {
        return $checkout_code;
    }
}
