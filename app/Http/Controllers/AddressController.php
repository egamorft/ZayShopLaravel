<?php

namespace App\Http\Controllers;

use App\Address;
use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id = Session::get('account_id');
        $query_address = Address::with('city_address')
        ->with('province_address')
            ->with('ward_address')
                ->where('account_id', $account_id)
                    ->orderBy('is_default', 'desc')
                    ->orderBy('city', 'asc')->get();
        return AddressResource::collection($query_address);
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
    public function store(AddressRequest $request)
    {
        $account_id = Session::get('account_id');
        $request->except('_token');
        $address = new Address();
        $address->account_id = $account_id;
        $address->city = $request->city;
        $address->province = $request->province;
        $address->ward = $request->ward;
        $address->specific_address = $request->specific_address;
        $address->address_type = $request->address_type;
        if ($request->is_default == true) {
            $address->is_default = 1;
            $is_default_address = Address::where('is_default', 1)->get();
            if ($is_default_address->count() > 0) {
                foreach ($is_default_address as $default) {
                    $default->is_default = 0;
                    $default->save();
                }
            }
        } else {
            $address->is_default = 0;
        }
        $address->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        return new AddressResource($address);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        if ($address->is_default == 0) {
            $address->is_default == 1;
            $is_default_address = Address::where('is_default', 1)->get();
            if ($is_default_address->count() > 0) {
                foreach ($is_default_address as $default) {
                    $default->is_default = 0;
                    $default->save();
                }
            }
        } else {
            $address->is_default == 0;
        }
        $address->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
