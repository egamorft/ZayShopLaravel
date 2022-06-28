<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function order()
    {
        $account_id = Session::get('account_id');
        $order = Order::where('account_id', $account_id)->get();
        $order_count = 0;
        foreach ($order as $key => $order) {
            $order_count++;
        }
        $order_paginate = Order::where('account_id', $account_id)->orderBy('order_id', 'desc')->paginate(5);
        return view('pages.profile.order_history')->with(compact('order_count', 'order_paginate'));
    }

    public function complete_order(Request $request)
    {
        $data = $request->all();
        $order_code = $data['order_code'];
        Order::where('order_code', $order_code)->update(['order_status' => 4]);
    }

    public function account()
    {
        return view('pages.profile.user_profile');
    }
}
