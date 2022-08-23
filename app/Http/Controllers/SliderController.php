<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminSliderRequest;
use App\Http\Resources\SliderResource;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
    public function recreate(Request $request, Slider $slider)
    {
        $request->validate([
            'slider_name' => 'required',
            'slider_status' => 'required'
        ]);
        $slider->slider_name = $request->slider_name;
        $slider->slider_desc = $request->slider_desc;
        $slider->slider_status = $request->slider_status;
        $get_image = $request->file('slider_image');
        if ($get_image) {
            $old_file_path = 'storage/app/public/sliders/' . $request->old_slider_image;
            unlink($old_file_path);
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . 
                $get_image->getClientOriginalExtension();
            $get_image->move('storage/app/public/sliders', $new_image);
            $slider->slider_image = $new_image;
            $slider->save();
        } else {
            $slider->save();
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminSliderRequest $request)
    {
        $request->except('_token');
        $slider = new Slider;
        $slider->slider_name = $request->slider_name;
        $slider->slider_desc = $request->slider_desc;
        $slider->slider_status = $request->slider_status;
        $get_image = $request->file('slider_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99)
                . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('storage/app/public/sliders', $new_image);
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
    public function edit(Slider $slider)
    {
        if ($slider->slider_status == 0) {
            $slider->slider_status = 1;
        } else {
            $slider->slider_status = 0;
        }
        $slider->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider_name = $slider->slider_image;
        $slider_path = 'storage/app/public/sliders/' . $slider_name;
        unlink($slider_path);
        $slider = Slider::find($slider->slider_id);
        $slider->delete();
    }
}
