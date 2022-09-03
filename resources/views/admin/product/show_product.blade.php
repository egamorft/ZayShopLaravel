@extends('components.admin_layout.admin_layout')
@section('admin_content')
@extends('components.alert.alert')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">
                            {{ __('admin/product.Product table')}}
                        </h6>
                    </div>
                </div>
                <div class="col-11 text-end">
                    <a href="{{URL::to('/add-product')}}" class="btn bg-gradient-dark mb-0">
                        <i class="material-icons text-sm">
                            add
                        </i>&nbsp;&nbsp;
                        {{ __('admin/product.Add Product')}}
                    </a>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="container mt-3">
                            <div class="d-flex justify-content-between">
                                <div class="input-group input-group-outline m-3">
                                    <label class="form-label">
                                        {{ __('admin/product.Search your product name')}}
                                    </label>
                                    <input type="text" id="myFilter" onkeyup="myFilter()" class="form-control">
                                </div>
                                <form class="input-group input-group-outline m-3">
                                    @csrf
                                    <select name="product_sort" id="product_sort" class="form-control">
                                        <option value="{{Request::url()}}?sort_by=none">{{ __('admin/product.Sort PRODUCT PRICE by')}}</option>
                                        <option value="{{Request::url()}}?sort_by=asc" {{Request::fullurl() == Request::url().'?sort_by=asc' ? "selected" : ""}}>{{ __('admin/product.Ascending')}}</option>
                                        <option value="{{Request::url()}}?sort_by=desc" {{Request::fullurl() == Request::url().'?sort_by=desc' ? "selected" : ""}}>{{ __('admin/product.Descending')}}</option>
                                    </select>
                                </form>
                                <form class="input-group input-group-outline m-3">
                                    @csrf
                                    <select name="product_filter_category" id="product_filter_category" class="form-control">
                                        <option value="{{Request::url()}}?filter_category_with=none">{{ __('admin/product.Filter CATEGORY by')}}</option>
                                        @if(!$get_category->isEmpty())
                                        @foreach($get_category as $key => $cate)
                                        <option value="{{Request::url()}}?filter_category_with={{$cate->category_id}}" 
                                                        {{Request::fullurl() == Request::url().'?filter_category_with='.$cate->category_id ? "selected" : ""}}>{{$cate->category_name}}
                                        </option>
                                        @endforeach
                                        @else
                                        <option disabled>{{ __('admin/product.No category available')}}</option>
                                        @endif
                                    </select>
                                </form>
                                <form class="input-group input-group-outline m-3">
                                    @csrf
                                    <select name="product_filter_subcategory" id="product_filter_subcategory" class="form-control">
                                        <option value="{{Request::url()}}?filter_subcategory_with=none">{{ __('admin/product.Filter SUBCATEGORY by')}}</option>
                                        @if(!$get_subcategory->isEmpty())
                                        @foreach($get_subcategory as $key => $subcate)
                                        <option value="{{Request::url()}}?filter_subcategory_with={{$subcate->subcategory_id}}" 
                                                        {{Request::fullurl() == Request::url().'?filter_subcategory_with='.$subcate->subcategory_id ? "selected" : ""}}>{{$subcate->subcategory_name}}</option>
                                        @endforeach
                                        @else
                                        <option disabled>{{ __('admin/product.No subcategory available')}}</option>
                                        @endif
                                    </select>
                                </form>
                                <form class="input-group input-group-outline m-3">
                                    @csrf
                                    <select name="product_filter_status" id="product_filter_status" class="form-control">
                                        <option value="{{Request::url()}}?filter_status_with=none">{{ __('admin/product.Filter PRODUCT STATUS by')}}</option>
                                        <option value="{{Request::url()}}?filter_status_with=1" {{Request::fullurl() == Request::url().'?filter_status_with=1' ? "selected" : ""}}>{{ __('admin/product.Show')}}</option>
                                        <option value="{{Request::url()}}?filter_status_with=0" {{Request::fullurl() == Request::url().'?filter_status_with=0' ? "selected" : ""}}>{{ __('admin/product.Hide')}}</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                        <table class="table align-items-center mb-0" id="filterTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                        {{ __('admin/product.ID')}}
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        {{ __('admin/product.Product Name')}}
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                        {{ __('admin/product.Product Quantity')}}
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                        {{ __('admin/product.Product Price')}}
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        {{ __('admin/product.Product Image')}}
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        {{ __('admin/product.Category')}}
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        {{ __('admin/product.Subcategory')}}
                                    </th>
                                    <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                        {{ __('admin/product.Show/Hide')}}
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$show_product->isEmpty())
                                @foreach($show_product as $key => $pro)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="justify-content-center">
                                                {{$pro->product_id}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$pro->product_name}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$pro->product_quantity}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$pro->product_price}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            <img src="{{ asset('storage/app/public/products/'.$pro->product_image) }}" height="130" width="130" alt="No image available">
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$pro->category_name}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$pro->subcategory_name}}
                                        </p>
                                    </td>

                                    <td class="align-middle text-center">
                                        <?php
                                        if ($pro->product_status == 1) {
                                        ?>
                                            <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}">
                                                <i class="material-icons" style="font-size: 40px; color:green;">
                                                    thumb_up
                                                </i>
                                            </a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="{{URL::to('/active-product/'.$pro->product_id)}}">
                                                <i class="material-icons" style="font-size: 40px; color:red;">
                                                    thumb_down
                                                </i>
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="font-weight-bold" data-toggle="tooltip">
                                            <i class="material-icons" style="font-size: 30px;">
                                                edit
                                            </i>
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <form action="{{ URL::to('/delete-product/'.$pro->product_id) }}" method="GET">
                                            @csrf
                                            <a type="button" class="font-weight-bold delete_product" data-toggle="tooltip">
                                                <i class="material-icons" style="font-size: 30px;">
                                                    delete
                                                </i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <td colspan="8"> 
                                    <center>
                                        <h3>
                                            {{ __('admin/product.Nothing here')}}
                                        </h3>
                                    </center>
                                </td>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $show_product->render('components.admin_paginate.admin_pagination')!!}

        </div>
    </div>

    @endsection