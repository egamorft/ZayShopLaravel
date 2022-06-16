<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show_order(){
        $order = Order::orderBy('created_at', 'DESC')->get();
        return view('admin.order.show_order')->with(compact('order'));
    }
}
