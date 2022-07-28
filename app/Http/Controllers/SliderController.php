<?php

namespace App\Http\Controllers;

use App\Http\Resources\SliderResource;
use App\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SliderResource::collection(Slider::orderBy('slider_id', 'desc')->paginate(2));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        return new SliderResource($slider);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        // $slider->delete();
    }
}
