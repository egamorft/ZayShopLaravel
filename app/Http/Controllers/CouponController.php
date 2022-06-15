<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function check_coupon(Request $request)
    {
        $data = $request->all();
        echo $data['coupon'];
    }

    public function show_coupon()
    {
        $show_coupon = DB::table('tbl_coupon')->orderBy('tbl_coupon.coupon_id', 'desc')->get();
        $manager_coupon = view('admin.show_coupon')->with('show_coupon', $show_coupon);
        return view('admin_layout')->with('admin.show_coupon', $manager_coupon);
    }

    public function add_coupon()
    {
        return view('admin.add_coupon');
    }

    public function save_coupon(Request $request)
    {
        $request->validate([
            'coupon_name' => 'required',
            'coupon_code' => 'required',
            'coupon_time' => 'required|numeric',
            'coupon_number' => 'required|numeric'
        ]);

        $data = array();
        $data['coupon_name'] = $request->coupon_name;
        $data['coupon_code'] = $request->coupon_code;
        $data['coupon_time'] = $request->coupon_time;
        $data['coupon_condition'] = $request->coupon_condition;
        $data['coupon_number'] = $request->coupon_number;

        if ($data['coupon_condition'] == null) {
            Session::put('error', 'Select coupon condition');
            return Redirect::to('/add-coupon');
        } else {
            DB::table('tbl_coupon')->insert($data);
            Session::put('message', 'Add coupon');
            return Redirect::to('/show-coupon');
        }
    }

    public function delete_coupon($coupon_id)
    {
        DB::table('tbl_coupon')->where('coupon_id', $coupon_id)->delete();
        Session::put('message', 'Successfully delete coupon ' . $coupon_id);
        return Redirect::to('/show-coupon');
    }
}
