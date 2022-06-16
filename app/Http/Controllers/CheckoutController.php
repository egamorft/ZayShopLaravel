<?php

namespace App\Http\Controllers;

use App\City;
use App\Feeship;
use App\Order;
use App\OrderDetails;
use App\Province;
use App\Shipping;
use App\Wards;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function check_out()
    {
        $city = City::orderby('matp', 'asc')->get();
        return view('pages.checkout.shop_checkout')->with(compact('city'));
    }

    public function confirm_order(Request $request)
    {
        $data = $request->all();
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();

        $checkout_code = substr(md5(microtime()), rand(0, 26), 5);
        $shipping_id = $shipping->shipping_id;

        $order = new Order();
        $order->account_id = Session::get('account_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = strtoupper($checkout_code);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at = now();
        $order->save();

        if (Cart::content()) {
            foreach (Cart::content() as $key => $cart) {
                $order_details = new OrderDetails();
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart->id;
                $order_details->product_name = $cart->name;
                $order_details->product_price = $cart->price;
                $order_details->product_sales_quantity = $cart->qty;
                $order_details->product_coupon = $data['order_coupon'];
                $order_details->product_feeship = $data['order_fee'];
                $order_details->save();
            }
            Cart::destroy();
            Session::forget('coupon');
            Session::forget('fee');
        }
    }
}
