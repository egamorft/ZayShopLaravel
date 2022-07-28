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
        $request->validate([
            'slider_name' => 'required',
            'slider_image' => 'required',
            'slider_status' => 'required'
        ]);
        $slider = new Slider;
        $slider->slider_name = $request->slider_name;
        $slider->slider_desc = $request->slider_desc;
        $slider->slider_status = $request->slider_status;
        $get_image = $request->file('slider_image');
        dump($get_image);
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.'
                . $get_image->getClientOriginalExtension();
            $get_image->move('public/upload/slider', $new_image);
            $slider->slider_image = $new_image;
            $slider->save();
        }
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
