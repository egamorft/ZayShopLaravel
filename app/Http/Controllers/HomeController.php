<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Login;
use App\Social;
use App\Rules\Captcha;
use Laravel\Socialite\Facades\Socialite;
use Psy\CodeCleaner\FunctionContextPass;

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
        $product = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_id', 'desc')->get();
        return view('pages.public.shop')->with(compact('category', 'subcategory', 'product'));
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
            Session::put('account_email', $result->account_email);
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
            if ($account_id) {
                Session::put('message', 'Successfully register your account, now you can login');
                return Redirect::to('/login');
            } else {
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

    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback_google()
    {
        $users = Socialite::driver('google')->stateless()->user();
        // return $users->id;
        $check_email_existed = DB::table('tbl_account')->where('account_email', $users->email)->first();
        if ($check_email_existed) {
            Session::put('account_name', $check_email_existed->account_name);
            Session::put('account_id', $check_email_existed->account_id);
            return redirect('/shop')->with('message', 'Successfully login');
        } else {
            $authUser = $this->findOrCreateUser($users, 'google');
            $account_name = Login::where('account_id', $authUser->user)->first();
            Session::put('account_name', $account_name->account_name);
            Session::put('account_id', $account_name->account_id);
            return redirect('/shop')->with('message', 'Successfully login with google');
        }
    }
    public function findOrCreateUser($users, $provider)
    {
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if ($authUser) {

            return $authUser;
        }

        $result = new Social([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);

        $orang = Login::where('account_email', $users->email)->first();

        if (!$orang) {
            $orang = Login::create([
                'account_name' => $users->name,
                'account_email' => $users->email,
                'account_password' => '',
                'account_phone' => ''
            ]);
        }
        $result->login()->associate($orang);
        $result->save();

        $account_name = Login::where('account_id', $result->user)->first();
        Session::put('account_name', $account_name->account_name);
        Session::put('account_id', $account_name->account_id);
        return redirect('/shop')->with('message', 'Successfully login');
    }


    public function login_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook()
    {
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider', 'facebook')->where('provider_user_id', $provider->getId())->first();
        if ($account) {
            $account_name = Login::where('account_id', $account->user)->first();
            Session::put('account_name', $account_name->account_name);
            Session::put('account_id', $account_name->account_id);
            return redirect('/shop')->with('message', 'Successfully login with facebook');
        } else {

            $result = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('account_email', $provider->getEmail())->first();

            if (!$orang) {
                $orang = Login::create([

                    'account_name' => $provider->getName(),
                    'account_email' => $provider->getEmail(),
                    'account_password' => '',
                    'account_phone' => ''

                ]);
            }
            $result->login()->associate($orang);
            $result->save();

            $account_name = Login::where('account_id', $result->user)->first();

            Session::put('account_name', $account_name->account_name);
            Session::put('account_id', $account_name->account_id);
            return redirect('/shop')->with('message', 'Successfully login with facebook');
        }
    }

    public function search(Request $request)
    {
        $keywords = $request->keywords_submit;
        $category = DB::table('tbl_category')->where('category_status', '1')->orderBy('category_id', 'asc')->get();
        $subcategory = DB::table('tbl_subcategory')->where('subcategory_status', '1')->orderBy('category_id', 'asc')->get();
        $product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keywords . '%')->get();
        return view('pages.product.search')->with(compact('category', 'subcategory', 'product'));
    }
}
