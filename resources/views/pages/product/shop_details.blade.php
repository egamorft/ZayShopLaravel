@extends('components.public_layout.layout')
@section('content')
@extends('components.alert.alert')

<!-- Open Content -->
@if(!$product_details->isEmpty())
@foreach($product_details as $key => $pro)
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <img class="card-img img-fluid" 
                        src="{{URL::to('/storage/app/public/products/'.$pro->product_image)}}" 
                            alt="Card image cap" id="product-detail">
                </div>
                <div class="row">
                    <!--Start Controls-->
                    <div class="col-1 align-self-center">
                        <a href="#multi-item-example" role="button" data-bs-slide="prev">
                            <i class="text-dark fas fa-chevron-left"></i>
                            <span class="sr-only">
                                Previous
                            </span>
                        </a>
                    </div>
                    <!--End Controls-->
                    <!--Start Carousel Wrapper-->
                    <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item" 
                        data-bs-ride="carousel">
                        <!--Start Slides-->
                        <div class="carousel-inner product-links-wap" role="listbox">

                            <!--First slide-->
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" 
                                                src="{{URL::to('/storage/app/public/products/'.$pro->product_image)}}" 
                                                    alt="Product Image 1">
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" 
                                                src="{{asset('public/frontend/images/product_single_02.jpg')}}" 
                                                    alt="Product Image 2">
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" 
                                                src="{{asset('public/frontend/images/product_single_03.jpg')}}" 
                                                    alt="Product Image 3">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--/.First slide-->

                            <!--Second slide-->
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" 
                                                src="{{asset('public/frontend/images/product_single_04.jpg')}}" 
                                                alt="Product Image 4">
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" 
                                                src="{{asset('public/frontend/images/product_single_05.jpg')}}" 
                                                alt="Product Image 5">
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" 
                                                src="{{asset('public/frontend/images/product_single_06.jpg')}}" 
                                                alt="Product Image 6">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--/.Second slide-->

                            <!--Third slide-->
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" 
                                                src="{{asset('public/frontend/images/product_single_07.jpg')}}" 
                                                    alt="Product Image 7">
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" 
                                                src="{{asset('public/frontend/images/product_single_08.jpg')}}" 
                                                    alt="Product Image 8">
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" 
                                                src="{{asset('public/frontend/images/product_single_09.jpg')}}" 
                                                    alt="Product Image 9">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--/.Third slide-->
                        </div>
                        <!--End Slides-->
                    </div>
                    <!--End Carousel Wrapper-->
                    <!--Start Controls-->
                    <div class="col-1 align-self-center">
                        <a href="#multi-item-example" role="button" data-bs-slide="next">
                            <i class="text-dark fas fa-chevron-right"></i>
                            <span class="sr-only">
                                Next
                            </span>
                        </a>
                    </div>
                    <!--End Controls-->
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2">
                            {{$pro->product_name}}
                        </h1>
                        <p class="h3 py-2">
                            {{number_format($pro->product_price, 0, ',' , '.').' '.'VNĐ'}}
                        </p>
                        <p class="py-2">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <span class="list-inline-item text-dark">
                                {{ __('public/shop.Rating') }} 5.0 | 36 {{ __('public/shop.Comments') }}
                            </span>
                        </p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>
                                    {{ __('public/shop.Subcategory:') }}
                                </h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted">
                                    <strong>
                                        {{$pro->subcategory_name}}
                                    </strong>
                                </p>
                            </li>
                        </ul>

                        <h6>
                            {{ __('public/shop.Description:') }}
                        </h6>
                        <p>
                            {!!$pro->product_desc!!}
                        </p>

                        <h6>
                            {{ __('public/shop.Content:') }}
                        </h6>
                        <ul class="list-unstyled pb-3">
                            <li>
                                {!!$pro->product_content!!}
                            </li>
                        </ul>

                        <h6>
                            {{ __('public/shop.Product available in stock:') }}
                        </h6>
                        <ul class="list-unstyled pb-3">
                            <li>
                                {{$pro->product_quantity}}
                            </li>
                        </ul>
                        <form action="{{URL::to('/save-cart')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-auto">
                                    <div class="form-outline">
                                        <h6>
                                            {{ __('public/shop.Quantity:') }}
                                        </h6>
                                        <input type="number" id="qty" 
                                            name="qty" class="form-control" min="1" value="1"/>
                                        <input type="hidden" 
                                            name="productid_hidden" value="{{$pro->product_id}}"/>
                                    </div>
                                </div>
                            </div>
                            </br>
                            <div class="row pb-3">
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg" 
                                        name="submit" value="addtocard">
                                        {{ __('public/shop.Add To Cart') }}
                                    </button>
                                </div>
                                <div class="col d-grid">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach
<!-- Close Content -->

<!-- Start Article -->
<section class="py-5">
    <div class="container">
        <div class="row text-left p-2 pb-3">
            <h4>
                {{ __('public/shop.Related Products') }}
            </h4>
        </div>

        <!--Start Carousel Wrapper-->
        
    @if(!$related_product->isEmpty())
        <div class="container-fluid">
            <div class="row">
                @foreach($related_product as $key => $relate)
                <div class="product-wap card rounded-0">
                    <div class="card rounded-0">
                        <a href="{{URL::to('/product-details/'.$relate->product_id)}}">
                            <img class="card-img rounded-0 img-fluid" 
                                src="{{URL::to('/storage/app/public/products/'.$relate->product_image)}}">
                        </a>
                    </div>
                    <div class="card-body">
                        <a href="{{URL::to('/product-details/'.$relate->product_id)}}" class="h3 text-decoration-none">
                            {{$relate->product_name}}
                        </a>
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
                            {{number_format($relate->product_price, 0, ',' , '.').' '.'VNĐ'}}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @endif

    </div>
</section>
@else
<center>
    <h1 class="m-5">
        Nothing here
    </h1>
</center>
@endif
<!-- End Article -->


@endsection