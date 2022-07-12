<?php

namespace App\Http\Controllers;

use App\Statistic;
use App\Visitors;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function home()
    {
        if(Session::get('admin_id')){
            return redirect()->back();
        }else{
            return view('admin.login.admin_login');
        }
    }

    public function dashboard(Request $request)
    {
        $user_ip_address = $request->ip();

        //Đầu tháng trước
        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();

        //Tầm này tháng trước
        $now_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->toDateString();

        //Cuối tháng trước
        $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        //Đầu tháng này
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();

        //1 năm trước
        $oneyears = Carbon::now('Asia/Ho_Chi_Minh')->subYear()->toDateString();

        //Đầu năm trước
        $start_last_year = Carbon::now('Asia/Ho_Chi_Minh')->subYear()->startOfYear()->toDateString();

        //Bây giờ
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        //Đầu năm nay
        $start_this_year = Carbon::now('Asia/Ho_Chi_Minh')->startOfYear()->toDateString();

        //Hôm qua
        $yesterday = Carbon::now('Asia/Ho_Chi_Minh')->subDay(1)->toDateString();

        //total last month
        $visitors_of_last_month = Visitors::whereBetween('visitors_date', [$early_last_month, $now_last_month])->get();
        $visitors_of_last_month_count = $visitors_of_last_month->count();

        //total this month
        $visitors_of_this_month = Visitors::whereBetween('visitors_date', [$early_this_month, $now])->get();
        $visitors_of_this_month_count = $visitors_of_this_month->count();

        //total in now from start year
        $visitors_of_this_year = Visitors::whereBetween('visitors_date', [$start_this_year, $now])->get();
        $visitors_of_this_year_count = $visitors_of_this_year->count();

        //total in today of last year from last year ( Cùng kỳ năm ngoái)
        $visitors_of_last_year = Visitors::whereBetween('visitors_date', [$start_last_year, $oneyears])->get();
        $visitors_of_last_year_count = $visitors_of_last_year->count();

        //total visitors
        $visitors = Visitors::all();
        $visitors_total_count = $visitors->count();

        //current online
        $visitors_current = Visitors::where('ip_address', $user_ip_address)->get();
        $visitors_count = $visitors_current->count();
        if ($visitors_count < 1) {
            $visitors = new Visitors();
            $visitors->ip_address = $user_ip_address;
            $visitors->visitors_date = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitors->save();
        }

        //Visitor online today
        $visitors_now = Visitors::where('visitors_date', $now)->get();
        $visitors_now_count = $visitors_now->count();

        //Visitor online yesterday
        $visitors_yesterday = Visitors::where('visitors_date', $yesterday)->get();
        $visitors_yesterday_count = $visitors_yesterday->count();

        return view('admin.dashboard.dashboard')->with(
            compact('visitors_total_count', 'visitors_count', 'visitors_yesterday_count', 'visitors_now_count',
            'visitors_of_last_month_count', 'visitors_of_this_month_count', 'visitors_of_this_year_count', 'visitors_of_last_year_count'));
    }

    public function login(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $request->validate([
            'admin_email' => 'required|min:8|email',
            'admin_password' => 'required|min:6'
        ]);
        $result = DB::table('tbl_admin')
            ->where('admin_email', $admin_email)
            ->where('admin_password', $admin_password)->first();

        if ($result) {
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        } else {
            Session::put('message', 'Email or password incorrect, try again!!');
            return Redirect::to('/admin');
        }
    }

    public function logout()
    {
        Session::flush();
        return Redirect::to('/admin');
    }

    public function filter_by_date(Request $request)
    {
        $data = $request->all();

        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Statistic::whereBetween('order_date', [$from_date, $to_date])->orderBy('order_date', 'asc')->get();

        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request)
    {
        $data = $request->all();

        $startThisMonth = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $startLastMonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $lastMonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subYear()->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if ($data['dashboard_value'] == '7days') {
            $get = Statistic::whereBetween('order_date', [$sub7days, $now])->orderBy('order_date', 'asc')->get();
        } elseif ($data['dashboard_value'] == 'lastmonth') {
            $get = Statistic::whereBetween('order_date', [$startLastMonth, $lastMonth])->orderBy('order_date', 'asc')->get();
        } elseif ($data['dashboard_value'] == 'thismonth') {
            $get = Statistic::whereBetween('order_date', [$startThisMonth, $now])->orderBy('order_date', 'asc')->get();
        } else {
            dump($sub365days);
            $get = Statistic::whereBetween('order_date', [$sub365days, $now])->orderBy('order_date', 'asc')->get();
        }

        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function days_order()
    {
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistic::whereBetween('order_date', [$sub30days, $now])->orderBy('order_date', 'asc')->get();

        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
}
