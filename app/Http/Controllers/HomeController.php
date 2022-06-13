<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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
    public function login_account(Request $request)
    {
        $request->validate([
            'account_email' => 'required|min:6|email',
            'account_password' => 'required|min:6'
        ]);
        $email = $request->account_email;
        $password = md5($request->account_password);
        $result = DB::table('tbl_account')->where('account_email', $email)
            ->where('account_password', $password)->first();
        if ($result) {
            Session::put('account_id', $result->account_id);
            Session::put('account_name', $result->account_name);
            return Redirect::to('/shop');
        } else {
            return redirect()->back()->with('error', 'Wrong username or password');
        }
    }
    public function register_account(Request $request)
    {
        $request->validate([
            'account_name' => 'required|min:6',
            'account_email' => 'required|min:6|email',
            'account_phone' => 'required|numeric|digits:10',
            'account_password' => 'required|min:6',
            'account_cfpassword' => 'required|same:account_password'
        ]);
        $email = $request->account_email;
        $result = DB::table('tbl_account')->where('account_email', $email)->first();
        if ($result) {
            return redirect()->back()->with('error', 'Email existed! Pls choose another email');
        } else {
            $data = array();
            $data['account_name'] = $request->account_name;
            $data['account_phone'] = $request->account_phone;
            $data['account_email'] = $request->account_email;
            $data['account_password'] = md5($request->account_password);

            $account_id = DB::table('tbl_account')->insertGetId($data);
            if($account_id){
                Session::put('message', 'Successfully register your account, now you can login');
                return Redirect::to('/login');
            }else{
                Session::put('error', 'Error');
                return Redirect::to('/register');
            }
        }
    }
    public function logout_account()
    {
        Session::flush();
        return Redirect::to('/login');
    }
}
