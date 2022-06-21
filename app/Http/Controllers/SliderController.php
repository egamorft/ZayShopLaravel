<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
{
    // public function AuthLogin()
    // {
    //     $admin_id = Session::get('admin_id');
    //     if ($admin_id) {
    //         return Redirect::to('admin.dashboard');
    //     } else {
    //         return Redirect::to('admin')->send();
    //     }
    // }

    //Admin Page
    public function show_slider()
    {
        // $this->AuthLogin();
        $slider = Slider::orderBy('slider_id', 'desc')->get();
        return view('admin.slider.show_slider')->with('slider', $slider);
    }

    public function add_slider()
    {
        // $this->AuthLogin();
        return view('admin.slider.add_slider');
    }

    public function save_slider(Request $request)
    {
        // $this->AuthLogin();
        $data = $request->all();
        $request->validate([
            'slider_name' => 'required',
            'slider_status' => 'required'
        ]);

        $slider = new Slider();
        $slider->slider_name = $data['slider_name'];
        $slider->slider_desc = $data['slider_desc'];
        $slider->slider_status = $data['slider_status'];
        $get_image = $request->file('slider_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/upload/slider', $new_image);
            $slider->slider_image = $new_image;
            $slider->save();
            Session::put('message', 'Add slider');
            return Redirect::to('/slider');
        } else {
            $slider->slider_image = '';
            Session::put('message', 'Add slider without image');
            return Redirect::to('/slider');
        }
    }
    public function unactive_slider($slider_id)
    {
        // $this->AuthLogin();
        Slider::where('slider_id', $slider_id)->update(['slider_status' => 0]);
        Session::put('message', 'Unactive slider ' . $slider_id);
        return Redirect::to('/slider');
    }

    public function active_slider($slider_id)
    {
        // $this->AuthLogin();
        Slider::where('slider_id', $slider_id)->update(['slider_status' => 1]);
        Session::put('message', 'Active slider ' . $slider_id);
        return Redirect::to('/slider');
    }

    public function edit_slider($slider_id)
    {
        // $this->AuthLogin();
        $edit_slider = Slider::where('slider_id', $slider_id)->get();
        return view('admin.slider.edit_slider')->with(compact('edit_slider'));
    }

    public function update_slider(Request $request, $slider_id)
    {
        // $this->AuthLogin();
        $data = $request->all();
        $slider = Slider::find($slider_id);
        $slider->slider_name = $data['slider_name'];
        $slider->slider_desc = $data['slider_desc'];
        $get_image = $request->file('slider_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/upload/slider', $new_image);
            $slider->slider_image = $new_image;
            $slider->save();
            Session::put('message', 'Update slider' . $slider_id);
            return Redirect::to('/slider');
        } else {
            $slider->save();
            Session::put('message', 'Update slider ' . $slider_id . ' without change image');
            return Redirect::to('/slider');
        }
    }

    public function delete_slider($slider_id)
    {
        // $this->AuthLogin();
        Slider::where('slider_id', $slider_id)->delete();
        Session::put('message', 'Successfully delete slider ' . $slider_id);
        return Redirect::to('/slider');
    }

    //End Admin Page
}
