@extends('components.layout')
@section('content')
@extends('components.alert')

<!-- Start Content -->
<div class="container py-5">
    <div class="row">

        <div class="col-lg-3">
            <h1 class="h2 pb-4">Categories</h1>
            <ul class="list-unstyled templatemo-accordion">
                <li class="pb-3">
                    @foreach($subcategory as $key => $sub)
                    @foreach($category as $key => $cate)
                    @if($cate->category_id == $sub->category_id)
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="{{URL::to('/category/'.$cate->category_id)}}">
                        {{$cate->category_name}}
                        <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul class="collapse show list-unstyled pl-3">
                        <li><a class="text-decoration-none" href="{{URL::to('/subcategory/'.$sub->subcategory_id)}}">{{$sub->subcategory_name}}</a></li>
                    </ul>
                    @endif
                    @endforeach
                    @endforeach
                </li>
            </ul>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-6">
                    <h2>Search result: </h2>
                </div>
                <div class="col-md-6 pb-4">
                    <div class="d-flex">
                        <select class="form-control">
                            <option>Featured</option>
                            <option>A to Z</option>
                            <option>Item</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($product as $key => $pro)
                <div class="col-md-4">
                    <form action="{{URL::to('/save-cart-home')}}" method="POST">
                        @csrf
                        <input type="hidden" name="productid_hidden" value="{{$pro->product_id}}" />
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" src="{{URL::to('/public/upload/product/'.$pro->product_image)}}">
                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li><a class="btn btn-success text-white" href="#"><i class="far fa-heart"></i></a></li>
                                        <li><a class="btn btn-success text-white mt-2" href="{{URL::to('/product-details/'.$pro->product_id)}}"><i class="far fa-eye"></i></a></li>
                                        <li><button type="submit" class="add-to-cart btn btn-success text-white mt-2" name="add-to-cart" data-id_product="{{$pro->product_id}}"><i class="fas fa-cart-plus"></i></button></li>
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
            </div>
            <div div="row">
                <ul class="pagination pagination-lg justify-content-end">
                    <li class="page-item disabled">
                        <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="#" tabindex="-1">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link rounded-0 shadow-sm border-top-0 border-left-0 text-dark" href="#">3</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
<!-- End Content -->


@endsection