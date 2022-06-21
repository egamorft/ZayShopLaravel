@extends('admin_layout')
@section('admin_content')

<!-- Alert -->
@if(session()->has('message'))
<div class="container">
    <div class="row">
        <div class="col-9"></div>
        <div class="col-sm-3">
            <div id="alertMessage" class="alert alert-success">
                <strong>Success! </strong>
                {{session()->get('message')}}
            </div>
        </div>
    </div>
</div>
</div>
<?php
Session::put('message', null);
?>
@elseif(session()->has('error'))
<div class="container">
    <div class="row">
        <div class="col-9"></div>
        <div class="col-sm-3">
            <div id="alertMessage" class="alert alert-danger">
                <strong>Error! </strong>
                {{session()->get('error')}}
            </div>
        </div>
    </div>
</div>
</div>
<?php
Session::put('error', null);
?>
@endif
<!-- End Alert -->

<div class="container">
    <div class="col-lg-11">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Add slider</h6>
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
                    <form role="form" method="POST" action="{{URL::to('/save-slider')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Slider Name</label>
                            <input name="slider_name" type="text" class="form-control">
                        </div>
                        @error('slider_name')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <div class="input-group input-group-outline mb-3">
                            <div class="col-md-3">
                                <span class="form-label">Slider Image</span>
                            </div>
                            <div class="col-md-9">
                                <input name="slider_image" type="file" class="form-control">
                            </div>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label" for="ckeditorAdd">Slider Description</label>
                            <textarea name="slider_desc" placeholder="Enter Slider Description" class="form-control" id="ckeditorAdd" rows="8"></textarea>
                        </div>
                        <div class="form-check mb-3 ">
                            <label class="form-check-label" for="show">Show</label>
                            <input class="form-check-input" type="radio" name="slider_status" id="show" value="1" checked>
                            <label class="form-check-label" for="hide">Hide</label>
                            <input class="form-check-input" type="radio" name="slider_status" id="hide" value="0">
                        </div>
                        @error('slider_status')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Add slider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection