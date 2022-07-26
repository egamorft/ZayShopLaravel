<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Http\Resources\CouponResource;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CouponResource::collection(Coupon::orderBy('coupon_id', 'desc')->paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'coupon_name' => 'required',
            'coupon_code' => 'required',
            'coupon_time' => 'required|numeric',
            'coupon_number' => 'required|numeric'
        ]);
        $coupon = new Coupon;
        $coupon->coupon_name = $request->coupon_name;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->coupon_time = $request->coupon_time;
        $coupon->coupon_number = $request->coupon_number;
        $coupon->coupon_condition = $request->coupon_condition;
        $coupon->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return new CouponResource($coupon);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'coupon_name' => 'required',
            'coupon_code' => 'required',
            'coupon_time' => 'required|numeric',
            'coupon_number' => 'required|numeric'
        ]);
        $coupon->coupon_name = $request->coupon_name;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->coupon_time = $request->coupon_time;
        $coupon->coupon_number = $request->coupon_number;
        $coupon->coupon_condition = $request->coupon_condition;
        $coupon->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
    }

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
                    ->withInput()->with('message', 'Add coupon successfully');
            }
        } else {
            return redirect()->back()
                    ->withInput()->with('error', 'Add coupon fail, wrong coupon');
        }
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
