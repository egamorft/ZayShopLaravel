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
                        <h6>Add product</h6>
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
                    <form role="form" method="POST" action="{{URL::to('/save-product')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Product Name</label>
                            <input name="product_name" type="text" class="form-control">
                        </div>
                        @error('product_name')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Product Price</label>
                            <input name="product_price" type="text" class="form-control">
                        </div>
                        @error('product_price')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <div class="input-group input-group-outline mb-3">
                            <div class="col-md-3">
                                <span class="form-label">Product Image</span>
                            </div>
                            <div class="col-md-9">
                                <input name="product_image" type="file" class="form-control">
                            </div>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label" for="ckeditorAdd">Product Description</label>
                            <textarea name="product_desc" placeholder="Enter Product Description" class="form-control" id="ckeditorAdd" rows="8"></textarea>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label" for="ckeditorAdd">Product Content</label>
                            <textarea name="product_content" placeholder="Enter Product Content" class="form-control" id="ckeditorAdd1" rows="8"></textarea>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <select name="category" id="category" class="form-control choose category">
                                <option value="">Choose your category</option>
                                @foreach($get_category as $key => $get_category)
                                <option value="{{$get_category->category_id}}">{{$get_category->category_name}}
                                    @endforeach
                            </select>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <select name="subcategory" id="subcategory" class="form-control subcategory choose">

                            </select>
                        </div>
                        <div class="form-check mb-3 ">
                            <label class="form-check-label" for="show">Show</label>
                            <input class="form-check-input" type="radio" name="product_status" id="show" value="1" checked>
                            <label class="form-check-label" for="hide">Hide</label>
                            <input class="form-check-input" type="radio" name="product_status" id="hide" value="0">
                        </div>
                        @error('product_status')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Add product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection