@extends('components.public_layout.layout')
@section('content')
@extends('components.alert.alert')

<!-- Start Content -->
<div class="container py-5">
    <div class="row">

        <div class="col-lg-3">
            <h1 class="h2 pb-4">{{ __('public/shop.Categories') }}</h1>
            <ul class="list-unstyled templatemo-accordion">
                @if(!$category->isEmpty())
                <li class="pb-3">
                    @foreach($category as $key => $cate)
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="{{URL::to('/category/'.$cate->category_id)}}">
                        {{$cate->category_name}}
                        <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul class="collapse show list-unstyled pl-3">
                        @foreach($subcategory as $key => $sub)
                        @if($cate->category_id == $sub->category_id)
                        <li><a class="text-decoration-none" href="{{URL::to('/subcategory/'.$sub->subcategory_id)}}">{{$sub->subcategory_name}}</a></li>
                        @endif
                        @endforeach
                    </ul>
                    @endforeach
                </li>
                @else
                <li aria-disabled="true">
                    {{ __('public/shop.No category available') }}
                </li>
                @endif
            </ul>
            <label for="amount">{{ __('public/shop.Sort price with') }}</label>
            <form>
                <div id="slider-range"></div>

                <input type="text" id="amount_start" readonly style="border:0; color:green; font-weight:bold;">
                <input type="text" id="amount_end" readonly style="border:0; color:green; font-weight:bold;">
                <input type="hidden" name="start_price" id="start_price">
                <input type="hidden" name="end_price" id="end_price">

                <hr>

                <input type="submit" name="filter_price" value="{{ __('public/shop.Sort by price') }}" class="btn btn-outline-success">
            </form>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6 pb-4">
                    <form>
                        <div class="d-flex">
                            @csrf
                            <select name="sort" id="sort" class="form-control">
                                <option disabled selected value="{{Request::url()}}?sort_by=none">{{ __('public/shop.Sort product') }}</option>
                                <option value="{{Request::url()}}?sort_by=desc" {{Request::fullurl() == Request::url().'?sort_by=desc' ? "selected" : ""}}>{{ __('public/shop.Descending') }}</option>
                                <option value="{{Request::url()}}?sort_by=asc" {{Request::fullurl() == Request::url().'?sort_by=asc' ? "selected" : ""}}>{{ __('public/shop.Ascending') }}</option>
                                <option value="{{Request::url()}}?sort_by=atoz" {{Request::fullurl() == Request::url().'?sort_by=atoz' ? "selected" : ""}}>{{ __('public/shop.A to Z') }}</option>
                                <option value="{{Request::url()}}?sort_by=ztoa" {{Request::fullurl() == Request::url().'?sort_by=ztoa' ? "selected" : ""}}>{{ __('public/shop.Z to A') }}</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
            @if(!$product->isEmpty())
                @foreach($product as $key => $pro)
                <div class="col-md-4">
                    <form action="{{URL::to('/save-cart-home')}}" method="POST">
                        @csrf
                        <input type="hidden" name="productid_hidden" value="{{$pro->product_id}}" />
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" src="{{URL::to('/storage/app/public/products/'.$pro->product_image)}}">
                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li><a class="btn btn-success text-white" href="#"><i class="far fa-heart"></i></a></li>
                                        <li><a class="btn btn-success text-white mt-2" href="{{URL::to('/product-details/'.$pro->product_id)}}">
                                                <i class="far fa-eye"></i></a></li>
                                        <li><button type="submit" class="add-to-cart btn btn-success text-white mt-2" name="add-to-cart" data-id_product="{{$pro->product_id}}">
                                                <i class="fas fa-cart-plus"></i></button></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{URL::to('/product-details/'.$pro->product_id)}}" class="h3 text-decoration-none">{{$pro->product_name}}</a>
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
                                <p class="text-center mb-0">{{number_format($pro->product_price, 0, ',' , '.').' '.'VNĐ'}}</p>
                            </div>
                        </div>
                    </form>
                </div>
                @endforeach
                @else
                    <center>
                        <h3>
                            {{ __('public/shop.No product here') }}
                        </h3>
                    </center>
                @endif
            </div>
            {!! $product->render('components.public_paginate.pagination')!!}
        </div>
    </div>
</div>
<!-- End Content -->


@endsection