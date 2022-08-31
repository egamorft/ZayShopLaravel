<?php

namespace App\Http\Controllers;

use App\City;
use App\Feeship;
use App\Province;
use App\Wards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class DeliveryController extends Controller
{
    public function update_delivery(Request $request)
    {
        $data = $request->all();
        $fee_ship = Feeship::find($data['feeship_id']);
        $fee_value = rtrim($data['fee_value'], '.');
        $fee_ship->fee_feeship = $fee_value;
        $fee_ship->save();
    }
    public function select_feeship()
    {
        $feeship = Feeship::orderby('fee_id', 'desc')->get();
        $output = '';
        $output .= '
        <div class="table-responsive">
            <table class="table table-bordered">
                <thread>
                    <tr>
                        <th>City Name</th>
                        <th>Province Name</th>
                        <th>Wards Name</th>
                        <th>Fee ship</th>
                    </tr>
                </thread>
                <tbody>
                ';
        foreach ($feeship as $key => $fee) {
            $output .= '
            <tr>
                <td>' . $fee->city->name_city . '</td>
                <td>' . $fee->province->name_quanhuyen . '</td>
                <td>' . $fee->wards->name_xaphuong . '</td>
                <td class="fee_feeship_edit" contenteditable 
                    data-feeship_id = "' . $fee->fee_id . '">
                    ' . number_format($fee->fee_feeship, 0, ',', '.') . '
                </td>
            </tr>
                    
        ';
        }

        $output .= '
                </tbody>
            </table>
        </div>
        ';

        echo $output;
    }
    public function insert_delivery(Request $request)
    {
        $request->validate([
            'fee_ship' => 'required|numeric|min:1'
        ]);
        $data = $request->all();
        $fee_ship = new Feeship();
        $fee_ship->fee_matp = $data['city'];
        $fee_ship->fee_maqh = $data['province'];
        $fee_ship->fee_xaid = $data['wards'];

        $check_matp = DB::table('tbl_feeship')
            ->where('fee_matp', $fee_ship->fee_matp)
            ->first();
        $check_maqh = DB::table('tbl_feeship')
            ->where('fee_maqh', $fee_ship->fee_maqh)
            ->first();
        $check_xaid = DB::table('tbl_feeship')
            ->where('fee_xaid', $fee_ship->fee_xaid)
            ->first();

        if ($check_matp == true && $check_maqh == true && $check_xaid == true) {
            Session::put('error', 'Dumplicate');
        } else {
            $fee_ship->fee_feeship = $data['fee_ship'];
            $fee_ship->save();
        }
    }

    public function delivery(Request $request)
    {
        $city = City::orderBy('matp', 'asc')->get();
        return view('admin.delivery.add_delivery')
            ->with(compact('city'));
    }

    public function select_delivery(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "city") {
                $select_province = Province::where('matp', $data['ma_id'])
                    ->orderby('maqh', 'asc')->get();
                $output .= '<option>-------Choose province-------</option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">
                        ' . $province->name_quanhuyen . '</option>';
                }
            } else {
                $select_wards = Wards::where('maqh', $data['ma_id'])
                    ->orderby('xaid', 'asc')->get();
                $output .= '<option>-------Choose wards-------</option>';

                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value="' . $ward->xaid . '">
                            ' . $ward->name_xaphuong . '</option>';
                }
            }
            echo $output;
        }
    }


    public function del_fee()
    {
        Session::forget('fee');
        Session::forget('address');

        return redirect()->back()->with('message', 'Delete old address');
    }
    public function calculate_fee(Request $request)
    {
        $data = $request->all();
        $city_id = $data['city'];
        $province_id = $data['province'];
        $ward_id = $data['ward'];

        $city = City::find($city_id);
        $province = Province::find($province_id);
        $ward = Wards::find($ward_id);
        Session::put('address', ['city' => $city->name_city, 
                                'province' => $province->name_quanhuyen,
                                'ward' => $ward->name_xaphuong]);
        if ($data['city']) {

            $feeship = Feeship::where('fee_matp', $data['city'])
                ->where('fee_maqh', $data['province'])
                ->where('fee_xaid', $data['ward'])->first();

            if ($feeship) {
                if(Session::get('fee')){
                    Session::forget('fee');
                }
                Session::put('fee', $feeship->fee_feeship);
                Session::save();
            } else {
                if(Session::get('fee')){
                    Session::forget('fee');
                }
                Session::put('fee', 50000);
                Session::save();
            }
        }
    }
    public function select_delivery_home(Request $request)
    {
        $data = $request->all();

        if ($data['action']) {
            $output = '';

            if ($data['action'] == "city") {
                $select_province = Province::where('matp', $data['ma_id'])
                    ->orderby('maqh', 'asc')->get();
                $output .= '<option>-------Choose province-------</option>';

                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">'
                        . $province->name_quanhuyen . '</option>';
                }
            } else {

                $select_wards = Wards::where('maqh', $data['ma_id'])
                    ->orderby('xaid', 'asc')->get();
                $output .= '<option>-------Choose wards-------</option>';

                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value="' . $ward->xaid . '">'
                        . $ward->name_xaphuong . '</option>';
                }
            }
            echo $output;
        }
    }
}
