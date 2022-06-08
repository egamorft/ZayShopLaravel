<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        return view('pages.public.home');
    }

    public function about(){
        return view('pages.public.about');
    }

    public function shop(){
        return view('pages.public.shop');
    }

    public function contact(){
        return view('pages.public.contact');
    }
}
