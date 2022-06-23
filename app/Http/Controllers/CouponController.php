<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;

class CouponController extends Controller
{
    public function check_coupon(Request $request)
    {
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon'])->first();
        if ($coupon) {
            $count_coupon = $coupon->count();
            if ($count_coupon > 0) {
                $coupon_session = Session::get('coupon');

                if ($coupon_session == true) {
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                    );
                    Session::put('coupon', $cou);

                } else {
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                    );
                    Session::put('coupon', $cou);
                }

                Session::save();
                return redirect()->back()
                    ->with('message', 'Add coupon successfully');
            }
        } else {
            return redirect()->back()
                ->with('error', 'Add coupon fail, wrong coupon');
        }
    }

    public function show_coupon()
    {
        $show_coupon = DB::table('tbl_coupon')
            ->orderBy('tbl_coupon.coupon_id', 'desc')
                ->get();
        $manager_coupon = view('admin.show_coupon')
            ->with('show_coupon', $show_coupon);

        return view('components.admin_layout')
            ->with('admin.show_coupon', $manager_coupon);
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
        DB::table('tbl_coupon')
            ->where('coupon_id', $coupon_id)
                ->delete();
                
        Session::put('message', 'Successfully delete coupon ' . $coupon_id);
        return Redirect::to('/show-coupon');
    }

    public function unset_coupon()
    {
        $coupon = Session::get('coupon');

        if ($coupon == true) {
            foreach ($coupon as $key => $cou) {
                if ($cou['coupon_condition'] == 1) {
                    Cart::setGlobalDiscount(0);
                }
            }
            
            Session::forget('coupon');
            return redirect()->back()
                ->with('message', 'Unset coupon');
        }
    }
}
