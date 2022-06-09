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
                        <h6>Add subcategory</h6>
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
                    <form role="form" method="POST" action="{{URL::to('/save-sub-category')}}">
                        @csrf
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">SubCategory Name</label>
                            <input name="subcategory_name" type="text" class="form-control">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label" for="ckeditorAdd">SubCategory Description</label>
                            <textarea name="subcategory_desc" placeholder="Enter SubCategory Description" class="form-control" id="ckeditorAdd" rows="8"></textarea>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label for="category_id" class="form-label">Choose your category from the list:</label>
                            <input class="form-control" list="category" name="category_id" id="category_id">
                            <datalist id="category">
                                @foreach($get_category as $key => $get_category)
                                <option value="{{$get_category->category_id}}">{{$get_category->category_name}}
                                @endforeach
                            </datalist>
                        </div>
                        <div class="form-check mb-3 ">
                            <label for="show">Show</label>
                            <input class="form-check-input" type="radio" name="subcategory_status" id="show" value="1" checked>
                            <label class="form-check-label" for="hide">Hide</label>
                            <input class="form-check-input" type="radio" name="subcategory_status" id="hide" value="0">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Add subcategory</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection