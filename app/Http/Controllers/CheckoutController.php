<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function check_out(){
        return view('pages.checkout.shop_checkout');
    }
}
