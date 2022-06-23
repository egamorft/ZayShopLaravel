@extends('components.admin_layout')
@section('admin_content')
@extends('components.alert')

<div class="container">
    <div class="col-lg-11">
        @foreach($edit_slider as $key => $edit_value)
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>
                            Edit slider: {{$edit_value->slider_name}}
                        </h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="dropdown float-lg-end pe-4">
                            <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v text-secondary"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="col-md-7 container">
                    <form role="form" method="POST" action="{{URL::to('/update-slider/'.$edit_value->slider_id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">
                                Slider Name
                            </label>
                            <input value="{{$edit_value->slider_name}}" name="slider_name" type="text" class="form-control">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <div class="col-md-3">
                                <span class="form-label">
                                    Slider Image
                                </span>
                            </div>
                            <div class="col-md-9">
                                <input name="slider_image" type="file" class="form-control" id="productImage" onchange="preview()">
                            </div>
                        </div>
                        <img id="frame" src="../public/upload/slider/{{$edit_value->slider_image}}" width="500" alt="No image available" />
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label" for="ckeditorAdd">
                                Slider Description
                            </label>
                            <textarea name="slider_desc" placeholder="Enter Slider Description" class="form-control" id="ckeditorAdd" rows="8">
                                {{$edit_value->slider_desc}} 
                            </textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">
                                Save Slider
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection