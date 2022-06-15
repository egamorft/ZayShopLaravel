<?php

namespace App\Http\Controllers;

use App\City;
use App\Feeship;
use App\Province;
use App\Wards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function check_out()
    {
        $city = City::orderby('matp', 'asc')->get();
        return view('pages.checkout.shop_checkout')->with(compact('city'));
    }
}
