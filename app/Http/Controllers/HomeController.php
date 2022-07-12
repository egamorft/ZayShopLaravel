<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Login;
use App\Product;
use App\Social;
use App\Rules\Captcha;
use App\Slider;
use App\Visitors;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Psy\CodeCleaner\FunctionContextPass;
use Symfony\Component\Console\Input\Input;

class HomeController extends Controller
{
    public function __construct(Request $request)
    {
        $user_ip = $request->ip();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $check_user_ip_today = Visitors::where('ip_address', $user_ip)->where('visitors_date', $today)->get();
        $check_user_ip_today_count = $check_user_ip_today->count();
        if($check_user_ip_today_count < 1){
            $visitors = new Visitors();
            $visitors->ip_address = $user_ip;
            $visitors->visitors_date = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitors->save();
        }
    }
    
    public function home()
    {
        $slider = Slider::where('slider_status', 1)
            ->orderBy('slider_id', 'desc')
            ->take(4)
            ->get();

        return view('pages.public.home')->with(compact('slider'));
    }

    public function about()
    {
        return view('pages.public.about');
    }

    public function shop()
    {
        $category = DB::table('tbl_category')
            ->where('category_status', '1')
            ->orderBy('category_id', 'asc')
            ->get();
        $subcategory = DB::table('tbl_subcategory')
            ->where('subcategory_status', '1')
            ->orderBy('category_id', 'asc')
            ->get();

        $min_price = Product::where('product_status', '1')->min('product_price');
        $max_price = Product::where('product_status', '1')->max('product_price');

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'asc') {
                $product = Product::orderBy('product_price', 'asc')
                    ->where('product_status', '1')
                    ->paginate(3)->appends(request()->query());
            } else if ($sort_by == 'desc') {
                $product = Product::orderBy('product_price', 'desc')
                    ->where('product_status', '1')
                    ->paginate(3)->appends(request()->query());
            } else if ($sort_by == 'atoz') {
                $product = Product::orderBy('product_name', 'asc')
                    ->where('product_status', '1')
                    ->paginate(3)->appends(request()->query());
            } else if ($sort_by == 'ztoa') {
                $product = Product::orderBy('product_name', 'desc')
                    ->where('product_status', '1')
                    ->paginate(3)->appends(request()->query());
            } else {
                $product = Product::orderBy('product_id', 'desc')
                    ->where('product_status', '1')
                    ->paginate(3);
            }
        } else if (isset($_GET['start_price']) && $_GET['end_price']) {
            $min_price = $_GET['start_price'];
            $max_price = $_GET['end_price'];
            $product = Product::whereBetween('product_price', [$min_price, $max_price])
                ->orderBy('product_id', 'asc')
                ->where('product_status', '1')
                ->paginate(3)->appends(request()->query());
        } else {
            $product = Product::orderBy('product_id', 'desc')
                ->where('product_status', '1')
                ->paginate(3);
        }



        return view('pages.public.shop')
            ->with(compact('category', 'subcategory', 'product', 'min_price', 'max_price'));
    }

    public function contact()
    {
        return view('pages.public.contact');
    }

    public function login()
    {
        if(Session::get('account_id')){
            return redirect()->back();
        }else{
            return view('pages.public.login');
        }
    }
    public function register()
    {
        if(Session::get('account_id')){
            return redirect()->back();
        }else{
            return view('pages.public.register');
        }
    }
    public function login_account(Request $request)
    {
        $request->validate(
            [
                'account_email' => 'required|min:6|email|exists:tbl_account,account_email',
                'account_password' => 'required|min:6'
            ],
            [
                'account_email.exists' => 'This email has not been register'
            ]
        );
        $email = $request->account_email;
        $password = md5($request->account_password);
        $result = DB::table('tbl_account')
            ->where('account_email', $email)
            ->where('account_password', $password)->first();

        if ($result) {
            if($result->account_confirmation == 1){
                Session::put('account_id', $result->account_id);
                Session::put('account_name', $result->account_name);
                Session::put('account_email', $result->account_email);
                Session::put('account_phone', $result->account_phone);
                Session::put('account_address', $result->account_address);

                Session::put('message', 'Successfully login with '. $result->account_name);
                return Redirect::to('/shop');

            }else{
                return Redirect::back()
                    ->withInput()->with('error', 'Your account have not confirm yet, check your email');

            }
        } else {
            return Redirect::back()
                ->withInput()->with('error', 'Wrong username or password');
        }
    }
    public function register_account(Request $request)
    {
        $request->validate(
            [
                'account_name' => 'required|min:6',
                'account_email' => 'required|min:6|email|unique:tbl_account,account_email',
                'account_phone' => 'required|numeric|digits:10',
                'account_password' => 'required|min:6',
                'account_cfpassword' => 'required|same:account_password',
                'g-recaptcha-response' => new Captcha(),
            ],
            [
                'account_email.unique' => 'This email has already been taken'
            ]
        );

        $email = $request->account_email;
        $result = DB::table('tbl_account')
            ->where('account_email', $email)
            ->first();

        if ($result) {
            return redirect()->back()
                ->with('error', 'Email existed! Pls choose another email');
        } else {

            $data = array();
            $data['account_name'] = $request->account_name;
            $data['account_phone'] = $request->account_phone;
            $data['account_email'] = $request->account_email;
            $data['account_password'] = md5($request->account_password);
            $data['verify_code'] = md5(uniqid());

            $account_id = DB::table('tbl_account')->insertGetId($data);

            if ($account_id) {
                return redirect()->route('confirm-account', $data);
            } else {
                Session::put('error', 'Error');
                return Redirect::to('/register');
            }
        }
    }

    public function check_verify($verify_code){
        $check_verify_code = Account::where('verify_code', $verify_code)->first();
        if($check_verify_code){
            DB::table('tbl_account')
                ->where('verify_code', $verify_code)
                ->update(['account_confirmation' => 1]);
            Session::put('message', 'Verify your account, now you can login');
            return Redirect::to('/login');
        }else{
            Session::put('error', 'Error');
            return Redirect::to('/register');
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
        $check_email_existed = DB::table('tbl_account')
            ->where('account_email', $users->email)
            ->first();

        if ($check_email_existed) {

            Session::put('account_name', $check_email_existed->account_name);
            Session::put('account_id', $check_email_existed->account_id);
            Session::put('account_email', $check_email_existed->account_email);
            Session::put('account_phone', $check_email_existed->account_phone);

            return redirect('/shop')->with('message', 'Successfully login');
        } else {

            $authUser = $this->findOrCreateUser($users, 'google');
            $account_name = Account::where('account_id', $authUser->user)->first();
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

        $orang = Account::where('account_email', $users->email)->first();

        if (!$orang) {

            $orang = Account::create([
                'account_name' => $users->name,
                'account_email' => $users->email,
                'account_password' => '',
                'account_phone' => '',
                'account_confirmation' => '1'
            ]);
        }
        $result->login()->associate($orang);
        $result->save();

        $account_name = Account::where('account_id', $result->user)->first();
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
        $account = Social::where('provider', 'facebook')
            ->where('provider_user_id', $provider->getId())
            ->first();

        if ($account) {
            $account_name = Account::where('account_id', $account->user)->first();
            Session::put('account_name', $account_name->account_name);
            Session::put('account_id', $account_name->account_id);
            return redirect('/shop')->with('message', 'Successfully login with facebook');
        } else {

            $result = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Account::where('account_email', $provider->getEmail())->first();

            if (!$orang) {
                $orang = Account::create([

                    'account_name' => $provider->getName(),
                    'account_email' => $provider->getEmail(),
                    'account_password' => '',
                    'account_phone' => '',
                    'account_confirmation' => '1'

                ]);
            }
            $result->login()->associate($orang);
            $result->save();

            $account_name = Account::where('account_id', $result->user)->first();

            Session::put('account_name', $account_name->account_name);
            Session::put('account_id', $account_name->account_id);
            return redirect('/shop')->with('message', 'Successfully login with facebook');
        }
    }

    public function search(Request $request)
    {
        $keywords = $request->keywords_submit;

        $category = DB::table('tbl_category')
            ->where('category_status', '1')
            ->orderBy('category_id', 'asc')->get();
        $subcategory = DB::table('tbl_subcategory')
            ->where('subcategory_status', '1')
            ->orderBy('category_id', 'asc')->get();

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'asc') {
                $product_search = Product::where('product_name', 'like', '%' . $keywords . '%')
                    ->where('product_status', '1')
                    ->orderBy('product_price', 'asc')
                    ->paginate(3)->appends(request()->query());
            } else if ($sort_by == 'desc') {
                $product_search = Product::where('product_name', 'like', '%' . $keywords . '%')
                    ->where('product_status', '1')
                    ->orderBy('product_price', 'desc')
                    ->paginate(3)->appends(request()->query());
            } else if ($sort_by == 'atoz') {
                $product_search = Product::where('product_name', 'like', '%' . $keywords . '%')
                    ->where('product_status', '1')
                    ->orderBy('product_name', 'asc')
                    ->paginate(3)->appends(request()->query());
            } else if ($sort_by == 'ztoa') {
                $product_search = Product::where('product_name', 'like', '%' . $keywords . '%')
                    ->where('product_status', '1')
                    ->orderBy('product_name', 'desc')
                    ->paginate(3)->appends(request()->query());
            } else {
                $product_search = Product::where('product_name', 'like', '%' . $keywords . '%')
                    ->where('product_status', '1')
                    ->paginate(3)->appends(request()->query());
            }
        } else {
            $product_search = Product::where('product_name', 'like', '%' . $keywords . '%')
                ->where('product_status', '1')
                ->paginate(3)->appends(request()->query());
        }
        return view('pages.product.search')
            ->with(compact('category', 'subcategory', 'product_search'));
    }
}
