<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        return view('pages.public.home');
    }

    public function about()
    {
        return view('pages.public.about');
    }

    public function shop()
    {
        $category = DB::table('tbl_category')->where('category_status', '1')->orderBy('category_id', 'asc')->get();
        $subcategory = DB::table('tbl_subcategory')->where('subcategory_status', '1')->orderBy('category_id', 'asc')->get();
        return view('pages.public.shop')->with(compact('category', 'subcategory'));
    }

    public function contact()
    {
        return view('pages.public.contact');
    }

    public function login()
    {
        return view('pages.public.login');
    }
    public function register()
    {
        return view('pages.public.register');
    }
}
