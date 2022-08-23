@extends('components.public_layout.layout')
@section('content')

<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($slider as $key => $sli)
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="{{$key}}" class="{{$key==0? 'active' : ''}}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @php
        $i = 0;
        @endphp
        @foreach($slider as $key => $slider)
        @php
        $i++;
        @endphp
        <div class="carousel-item {{$i==1 ? 'active' : '' }}">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="storage/app/public/sliders/{{$slider->slider_image}}" alt="Slider">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">{{$slider->slider_name}}</h1>
                            {!!$slider->slider_desc!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
<!-- End Banner Hero -->


<!-- Start Categories of The Month -->
<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">{{ __('public/home.Categories of The Month') }}</h1>
            <p>
                {{ __('public/home.Here are the notable categories this month') }}
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-4 p-5 mt-3">
            <a href="#"><img src="{{('public/frontend/images/category_img_01.jpg')}}" class="rounded-circle img-fluid border"></a>
            <h5 class="text-center mt-3 mb-3">{{ __('public/home.Watches') }}</h5>
            <p class="text-center"><a href="shop" class="btn btn-success">{{ __('public/home.Go Shop') }}</a></p>
        </div>
        <div class="col-12 col-md-4 p-5 mt-3">
            <a href="#"><img src="{{('public/frontend/images/category_img_02.jpg')}}" class="rounded-circle img-fluid border"></a>
            <h2 class="h5 text-center mt-3 mb-3">{{ __('public/home.Shoes') }}</h2>
            <p class="text-center"><a href="shop" class="btn btn-success">{{ __('public/home.Go Shop') }}</a></p>
        </div>
        <div class="col-12 col-md-4 p-5 mt-3">
            <a href="#"><img src="{{('public/frontend/images/category_img_03.jpg')}}" class="rounded-circle img-fluid border"></a>
            <h2 class="h5 text-center mt-3 mb-3">{{ __('public/home.Accessories') }}</h2>
            <p class="text-center"><a href="shop" class="btn btn-success">{{ __('public/home.Go Shop') }}</a></p>
        </div>
    </div>
</section>
<!-- End Categories of The Month -->

@endsection