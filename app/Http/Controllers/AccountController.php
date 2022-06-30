<?php

namespace App\Http\Controllers;

use App\Account;
use App\Order;
use App\OrderDetails;
use App\Statistic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function order()
    {
        $account_id = Session::get('account_id');
        $order = Order::with('shipping')->where('account_id', $account_id)->get();
        $order_count = 0;
        foreach ($order as $key => $order) {
            $order_count++;
        }
        $order_paginate = Order::with('shipping')->where('account_id', $account_id)->orderBy('order_id', 'desc')->paginate(5);
        return view('pages.profile.order_history')->with(compact('order_count', 'order_paginate'));
    }

    public function complete_order(Request $request)
    {
        $data = $request->all();
        $order_code = $data['order_code'];
        Order::where('order_code', $order_code)->update(['order_status' => 4]);
        $get_order = OrderDetails::where('order_code', $order_code)->get();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $order_total = $get_order->count();
        $quantity = 0;
        $sales = 0;
        foreach ($get_order as $key => $order) {
            $quantity += $order->product_sales_quantity;
            $sales += $order->product_price * $order->product_sales_quantity;
        }
        $profit = $sales * 70 / 100;
        $statistic = new Statistic();
        $statistic->order_date = $today;
        $statistic->sales = $sales;
        $statistic->profit = $profit;
        $statistic->quantity = $quantity;
        $statistic->total_order = $order_total;
        $statistic->save();
    }

    public function account()
    {
        return view('pages.profile.user_profile');
    }

    public function save_profile(Request $request)
    {
        $request->validate(
            [
                'account_name' => 'required|min:6',
                'account_email' => 'required|min:6|email|same:account_email_check',
                'account_phone' => 'required|numeric|digits:10',
            ],
            [
                'account_email.same' => 'You can not change your email'
            ]
        );

        $data = $request->all();

        $get_account = Account::where('account_id', Session::get('account_id'))->first();

        $get_account->account_name = $data['account_name'];
        $get_account->account_address = $data['account_address'];
        $get_account->account_phone = $data['account_phone'];
        $get_account->update();
        Session::put('message', 'Change your infomation');
        Session::forget('account_name');
        Session::forget('account_address');
        Session::forget('account_phone');
        Session::put('account_name', $get_account->account_name);
        Session::put('account_address', $get_account->account_address);
        Session::put('account_phone', $get_account->account_phone);
        return Redirect::back();
    }

    public function change_password()
    {
        return view('pages.profile.chgpwd');
    }

    public function save_password(Request $request)
    {
        $request->validate(
            [
                'old_password' => 'required|min:6',
                'new_password' => 'required|min:6|confirmed'
            ]
        );

        $data = $request->all();

        $get_account = Account::where('account_id', Session::get('account_id'))->first();

        $get_old_password = $get_account->account_password;
        if ($get_old_password == md5($data['old_password'])) {
            $get_account->account_password = md5($data['new_password']);
            $get_account->update();
            Session::put('message', 'Change your password');
            return Redirect::back();
        } else {
            Session::put('error', 'Old password is wrong');
            return Redirect::back();
        }
    }
}
