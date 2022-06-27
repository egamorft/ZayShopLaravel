@extends('components.public_layout.layout')
@section('content')
@extends('components.alert.alert')

<!-- Start Content -->
<div class="container py-5">
    <div class="row">

        <div class="col-lg-3">
            <h1 class="h2 pb-4">
                Categories
            </h1>
            <ul class="list-unstyled templatemo-accordion">
                <li class="pb-3">
                    @foreach($category as $key => $cate)
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="{{URL::to('/category/'.$cate->category_id)}}">
                        {{$cate->category_name}}
                        <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul class="collapse show list-unstyled pl-3">
                        @foreach($subcategory as $key => $sub)
                        @if($cate->category_id == $sub->category_id)
                        <li>
                            <a class="text-decoration-none" 
                                href="{{URL::to('/subcategory/'.$sub->subcategory_id)}}">
                                {{$sub->subcategory_name}}
                            </a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                    @endforeach
                </li>
            </ul>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-6">
                    <!-- <ul class="list-inline shop-top-menu pb-3 pt-1">
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none mr-3" href="#">All</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none mr-3" href="#">Men's</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none" href="#">Women's</a>
                        </li>
                    </ul> -->
                </div>
                <div class="col-md-6 pb-4">
                    <div class="d-flex">
                        <select class="form-control">
                            <option>
                                Featured
                            </option>
                            <option>
                                A to Z
                            </option>
                            <option>
                                Item
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($category_by_id as $key => $pro)
                <div class="col-md-4">
                    <div class="card mb-4 product-wap rounded-0">
                        <div class="card rounded-0">
                            <img class="card-img rounded-0 img-fluid" src="{{URL::to('/public/upload/product/'.$pro->product_image)}}">
                            <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                <ul class="list-unstyled">
                                    <li>
                                        <a class="btn btn-success text-white" href="#">
                                            <i class="far fa-heart"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="btn btn-success text-white mt-2" 
                                            href="{{URL::to('/product-details/'.$pro->product_id)}}">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="btn btn-success text-white mt-2" href="#">
                                            <i class="fas fa-cart-plus"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="{{URL::to('/product-details/'.$pro->product_id)}}" 
                                class="h3 text-decoration-none">
                                    {{$pro->product_name}}
                            </a>
                            <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                <li class="pt-2">
                                    <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                </li>
                            </ul>
                            <ul class="list-unstyled d-flex justify-content-center mb-1">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                </li>
                            </ul>
                            <p class="text-center mb-0">
                                {{number_format($pro->product_price, 0, ',' , '.').' '.'VNĐ'}}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {!! $category_by_id->render('components.public_paginate.pagination')!!}
        </div>

    </div>
</div>
<!-- End Content -->



@endsection