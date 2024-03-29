<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ __('public/layout.Zay Shop') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (Route::currentRouteNamed('profile.address'))
        <meta name="csrf-token" content="{{csrf_token()}}">
        <script>
            window.Laravel = {
                csrfToken: '{{csrf_token()}}'
            }
        </script>
    @endif

    <link rel="apple-touch-icon" href="{{asset('public/frontend/images/apple-icon.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/frontend/images/favicon.ico')}}">

    <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/templatemo.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/custom.css')}}">
    <script src="https://kit.fontawesome.com/6e0f5e30b4.js" crossorigin="anonymous"></script>
    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <!-- <link rel="stylesheet" href="{{('public/frontend/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{('public/frontend/css/fontawesome.css')}}"> -->
    <!-- Load map styles -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" 
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    @yield('userDashboard')
    <!--
    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
</head>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">
                        tungnh3011.work@gmail.com
                    </a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">
                        0888736810
                    </a>
                </div>
                
                <div>
                <select onchange="window.location.href = '?lang=' + this.value">
                    <option value="en" {{ Cookie::get("lang") == "en" ? "selected" : "" }}>ENG</option>
                    <option value="vi" {{ Cookie::get("lang") == "vi" ? "selected" : "" }}>VIE</option>
                </select>
                    <a class="text-light" href="https://fb.com/egamorft" target="_blank" rel="sponsored">
                        <i class="fab fa-facebook-f fa-sm fa-fw me-2"></i>
                    </a>
                    <a class="text-light" href="https://www.instagram.com/egamorft.blade.php" target="_blank">
                        <i class="fab fa-instagram fa-sm fa-fw me-2"></i>
                    </a>
                    <a class="text-light" href="#" target="_blank">
                        <i class="fab fa-twitter fa-sm fa-fw me-2"></i>
                    </a>
                    <a class="text-light" href="https://www.linkedin.com/in/tung-nguyen-b7ba49242" target="_blank">
                        <i class="fab fa-linkedin fa-sm fa-fw"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->


    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="{{URL::to('/')}}">
                Zay
            </a>

            <button class="navbar-toggler border-0" 
                type="button" data-bs-toggle="collapse" 
                    data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" 
                        aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" 
                id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{URL::to('/')}}">
                                {{ __('public/layout.Home') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{URL::to('/about')}}">
                                {{ __('public/layout.About Us') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{URL::to('/shop')}}">
                                {{ __('public/layout.Shop') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{URL::to('/contact')}}">
                                {{ __('public/layout.Contact') }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Modal -->
                <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="w-100 pt-1 mb-5 text-right">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{URL::to('/search')}}" method="GET" class="modal-content modal-body border-0 p-0">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="inputModalSearch" name="keywords_submit" placeholder="{{ __('public/layout.Search') }} ...">
                                <button type="submit" class="input-group-text bg-success text-light">
                                    <i class="fa fa-fw fa-search text-white"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Modal -->

                <div class="navbar align-self-center d-flex">
                    <!-- <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div> -->
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-dark mr-2"></i>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="{{URL::to('/shop-cart')}}" aria-placeholder="cart">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">
                            {{count(Cart::content())}}
                        </span>
                    </a>
                    <?php

                    $account_id = Session::get('account_id');
                    $account_name = Session::get('account_name');
                    if ($account_id != null) {
                        ?>
                        <div class="dropdown">
                            <a class="nav-icon position-relative text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                <i class="fa fa-fw fa-user text-dark mr-3"></i>
                                {{ __('public/layout.Hello') }}
                                <?php
                                echo $account_name
                        ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <h5 class="dropdown-header">
                                        {{ __('public/layout.Account action') }}
                                    </h5>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{URL::to('/profile/account')}}">
                                        {{ __('public/layout.My profile') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{URL::to('/profile/order')}}">
                                        {{ __('public/layout.Order History') }}
                                    </a>
                                </li>
                                <li>
                                    <h5 class="dropdown-header">
                                        {{ __('public/layout.Logout') }}
                                    </h5>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{URL::to('/logout_account')}}">
                                        {{ __('public/layout.Logout') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php
                    } else {
                        ?>
                        <div class="dropdown">
                            <a class="nav-icon position-relative text-decoration-none" href="{{URL::to('/login')}}">
                                <i class="fa fa-fw fa-lock text-dark mr-3"></i>
                                {{ __('public/layout.Login') }}
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header -->
    @yield('alert_content')
    @yield('content')

    <!-- Start Brands -->
    <section class="bg-light py-5">
        <div class="container my-4">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">{{ __('public/layout.Our Brands') }}</h1>
                    <p>
                    {{ __('public/layout.It is important to have a good customer, it is going to be successful, but that is how it is important to have a good customer.') }}
                    </p>
                </div>
                <div class="col-lg-9 m-auto tempaltemo-carousel">
                    <div class="row d-flex flex-row">
                        <!--Controls-->
                        <div class="col-1 align-self-center">
                            <a class="h1" href="#multi-item-example" role="button" data-bs-slide="prev">
                                <i class="text-light fas fa-chevron-left"></i>
                            </a>
                        </div>
                        <!--End Controls-->

                        <!--Carousel Wrapper-->
                        <div class="col">
                            <div class="carousel slide carousel-multi-item pt-2 pt-md-0" id="multi-item-example" data-bs-ride="carousel">
                                <!--Slides-->
                                <div class="carousel-inner product-links-wap" role="listbox">

                                    <!--First slide-->
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-3 p-md-5">
                                                <a href="#">
                                                    <img class="img-fluid brand-img" src="{{asset('public/frontend/images/brand_01.png')}}" alt="Brand Logo">
                                                </a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#">
                                                    <img class="img-fluid brand-img" src="{{asset('public/frontend/images/brand_02.png')}}" alt="Brand Logo">
                                                </a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#">
                                                    <img class="img-fluid brand-img" src="{{asset('public/frontend/images/brand_03.png')}}" alt="Brand Logo">
                                                </a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#">
                                                    <img class="img-fluid brand-img" src="{{asset('public/frontend/images/brand_04.png')}}" alt="Brand Logo">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End First slide-->

                                    <!--Second slide-->
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-3 p-md-5">
                                                <a href="#">
                                                    <img class="img-fluid brand-img" src="{{asset('public/frontend/images/brand_01.png')}}" alt="Brand Logo">
                                                </a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#">
                                                    <img class="img-fluid brand-img" src="{{asset('public/frontend/images/brand_02.png')}}" alt="Brand Logo">
                                                </a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#">
                                                    <img class="img-fluid brand-img" src="{{asset('public/frontend/images/brand_03.png')}}" alt="Brand Logo">
                                                </a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#">
                                                    <img class="img-fluid brand-img" src="{{asset('public/frontend/images/brand_04.png')}}" alt="Brand Logo">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Second slide-->

                                    <!--Third slide-->
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-3 p-md-5">
                                                <a href="#">
                                                    <img class="img-fluid brand-img" src="{{asset('public/frontend/images/brand_01.png')}}" alt="Brand Logo">
                                                </a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#">
                                                    <img class="img-fluid brand-img" src="{{asset('public/frontend/images/brand_02.png')}}" alt="Brand Logo">
                                                </a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#">
                                                    <img class="img-fluid brand-img" src="{{asset('public/frontend/images/brand_03.png')}}" alt="Brand Logo">
                                                </a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#">
                                                    <img class="img-fluid brand-img" src="{{asset('public/frontend/images/brand_04.png')}}" alt="Brand Logo">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Third slide-->

                                </div>
                                <!--End Slides-->
                            </div>
                        </div>
                        <!--End Carousel Wrapper-->

                        <!--Controls-->
                        <div class="col-1 align-self-center">
                            <a class="h1" href="#multi-item-example" role="button" data-bs-slide="next">
                                <i class="text-light fas fa-chevron-right"></i>
                            </a>
                        </div>
                        <!--End Controls-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Brands-->

    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">
                        Zay Shop
                    </h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            3 Duy Tan, Dich Vong Hau, Cau Giay, Ha Noi
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:0888736810">
                                0888736810
                            </a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:tungnh3011.work@gmail.com">
                                tungnh3011.work@gmail.com
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">
                        {{ __('public/layout.Products') }}
                    </h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <a class="text-decoration-none" href="#">
                                {{ __('public/layout.Luxury') }}
                            </a>
                        </li>
                        <li>
                            <a class="text-decoration-none" href="#">
                                {{ __('public/layout.Sport Wear') }}
                            </a>
                        </li>
                        <li>
                            <a class="text-decoration-none" href="#">
                                {{ __("public/layout.Men's Shoes") }}
                            </a>
                        </li>
                        <li>
                            <a class="text-decoration-none" href="#">
                                {{ __("public/layout.Women's Shoes") }}
                            </a>
                        </li>
                        <li>
                            <a class="text-decoration-none" href="#">
                                {{ __('public/layout.Popular Dress') }}
                            </a>
                        </li>
                        <li>
                            <a class="text-decoration-none" href="#">
                                {{ __('public/layout.Gym Accessories') }}
                            </a>
                        </li>
                        <li>
                            <a class="text-decoration-none" href="#">
                                {{ __('public/layout.Sport Shoes') }}
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">
                        {{ __('public/layout.Further Info') }}
                    </h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <a class="text-decoration-none" href="{{URL::to('/')}}">
                                {{ __('public/layout.Home') }}
                            </a>
                        </li>
                        <li>
                            <a class="text-decoration-none" href="{{URL::to('/about')}}">
                                {{ __('public/layout.About Us') }}
                            </a>
                        </li>
                        <li>
                            <a class="text-decoration-none" href="{{URL::to('/contact')}}">
                                {{ __('public/layout.Shop Locations') }}
                            </a>
                        </li>
                        <li>
                            <a class="text-decoration-none" href="#">
                                {{ __('public/layout.FAQs') }}
                            </a>
                        </li>
                        <li>
                            <a class="text-decoration-none" href="{{URL::to('/contact')}}">
                                {{ __('public/layout.Contact') }}
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/egamorft">
                                <i class="fab fa-facebook-f fa-lg fa-fw"></i>
                            </a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/egamorft.blade.php">
                                <i class="fab fa-instagram fa-lg fa-fw"></i>
                            </a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="#">
                                <i class="fab fa-twitter fa-lg fa-fw"></i>
                            </a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/in/tung-nguyen-b7ba49242">
                                <i class="fab fa-linkedin fa-lg fa-fw"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-auto">
                    <label class="sr-only" for="subscribeEmail">
                            {{ __('public/layout.Email address') }}
                    </label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control bg-dark border-light" id="subscribeEmail" placeholder="{{ __('public/layout.Email address') }}">
                        <div class="input-group-text btn-success text-light">
                            {{ __('public/layout.Subscribe') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            {{ __('public/layout.Copyright') }} &copy; 2022 Co-well asia
                            | {{ __('public/layout.Designed by') }}
                            <a rel="sponsored" href="https://facebook.com/egamorft" target="_blank">
                                Egamorft
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    @if (Route::currentRouteNamed('profile.address') ||
            Route::currentRouteNamed('check-out'))
    <script src="{{url('public/js/app.js')}}"></script>
    @endif
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{asset('public/frontend/js/sweetalert.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery-1.11.0.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery-migrate-1.2.1.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/templatemo.js')}}"></script>
    <script src="{{asset('public/frontend/js/custom.js')}}"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="{{asset('public/frontend/js/slick.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/simple.money.format.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    
    @if(Route::currentRouteNamed('check-out'))
            <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
            <script>
                initPayPalButton();
                function initPayPalButton() {
                if(document.getElementById("fee_ship") != null){
                    var total_usd = document.getElementById("total_usd").value;
                    paypal.Buttons({
                    style: {
                    shape: 'pill',
                    color: 'gold',
                    layout: 'vertical',
                    label: 'checkout',
                    
                    },

                    createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{"amount":{"currency_code":"USD","value":total_usd}}]
                    });
                    },

                    onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {
                        // Full available details
                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                        // Show a success message within this page, e.g.
                        // const element = document.getElementById('paypal-button-container');
                        // element.innerHTML = '';
                        // actions.redirect('http://localhost/shopZay/check-out?status='+orderData.status);
                        var shipping_notes = $('.shipping_notes').val();
                        var shipping_address = $('#specific_address').text().trim();
                        var shipping_city = $('input[name="city_name"]').val();
                        var shipping_province = $('input[name="province_name"]').val();
                        var shipping_ward = $('input[name="ward_name"]').val();
                        var order_coupon = $('.order_coupon').val();
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: '{{url("/send-mail-confirm-order")}}',
                            method: 'POST',
                            data: {
                                shipping_email: orderData.payer.email_address,
                                shipping_name: orderData.payer.name.given_name + " "+ orderData.payer.name.surname,
                                shipping_address: orderData.payer.address.address_line_1,
                                shipping_phone: orderData.payer.phone.phone_number.national_number,
                                order_fee: 0,
                                shipping_notes: shipping_notes,
                                _token: _token
                            },
                            beforeSend: function(){
                                Swal.fire({
                                    title: 'Please Wait !',
                                    allowOutsideClick: false,
                                    showConfirmButton: false,
                                    didOpen: () => {
                                        Swal.showLoading()
                                    },
                                });

                            },
                            success: function() {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Your order has been saved',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                $.ajax({
                                    url: "{{url('/confirm-order')}}",
                                    method: 'POST',
                                    data: {
                                        shipping_email: orderData.payer.email_address,
                                        shipping_name: orderData.payer.name.given_name + " "+ orderData.payer.name.surname,
                                        shipping_address: shipping_address,
                                        shipping_city: shipping_city,
                                        shipping_province: shipping_province,
                                        shipping_ward: shipping_ward,
                                        shipping_phone: orderData.payer.phone.phone_number.national_number,
                                        shipping_notes: shipping_notes,
                                        payment_select: 3,
                                        order_fee: 0,
                                        order_coupon: order_coupon,
                                        _token: _token
                                    },
                                    success: function() {
                                        var paid = document.getElementById("paid");
                                        if (paid.style.display === "none") {
                                            paid.style.display = "block"
                                        }

                                        $("#OrderBill").modal("toggle");

                                        $('#closeBill').click(function() {
                                            window.location.href = "{{ URL::to('/profile/order')}}";
                                        });
                                    }
                                });

                            }
                        });
                        // Or go to another URL:  actions.redirect('thank_you.html');
                        
                    });
                    },

                    onError: function(err) {
                        Swal.fire(
                            'Oops!',
                            'Try again!!',
                            'warning'
                        )
                    }
                }).render('#paypal-button-container');
                }else{
                    document.getElementById("paypalfield").innerHTML = "<h3>Choose your city for paypal payment</h3>"
                }
            }
            </script>
    @endif
   
    <script>
        $('.payment_select').change(function() {
            const check_out = document.getElementById('check_out');
            if($(this).val() == 1){
                check_out.name = 'cod';
            }else if($(this).val() == 2){
                check_out.name = 'momo';
            }
        })
    </script>

    @if(Route::currentRouteNamed('shop'))
    <script>
        $("#slider-range").slider({
            range: true,
            min: {{$min_price}},
            max: {{$max_price}},
            values: [{{$min_price}}, {{$max_price}}],
            slide: function(event, ui) {
                $("#amount_start").val(ui.values[0]).simpleMoneyFormat();
                $("#amount_end").val(ui.values[1]).simpleMoneyFormat();

                $("#start_price").val(ui.values[0]);
                $("#end_price").val(ui.values[1]);
            }
        });
        $("#amount_start").val($("#slider-range").slider("values", 0)).simpleMoneyFormat();
        $("#amount_end").val($("#slider-range").slider("values", 1)).simpleMoneyFormat();
    </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#check_out').click(function() {
                if($(this).attr('name') =='cod'){           //COD
                    Swal.fire({
                        title: 'Ready to submit your order?',
                        text: "Check your information and your shopping cart carefully",
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonColor: '#d33',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, submit now!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var shipping_email = $('.shipping_email').val();
                            var shipping_name = $('.shipping_name').val();
                            var shipping_address = $('#specific_address').text().trim();
                            var shipping_phone = $('.shipping_phone').val();
                            var shipping_notes = $('.shipping_notes').val();
                            var shipping_city = $('input[name="city_name"]').val();
                            var shipping_province = $('input[name="province_name"]').val();
                            var shipping_ward = $('input[name="ward_name"]').val();
                            var payment_select = $('.payment_select').val();
                            var order_fee = $('.order_fee').val();
                            var order_coupon = $('.order_coupon').val();
                            var _token = $('input[name="_token"]').val();

                            if (order_fee) {
                                if (shipping_email && shipping_name && shipping_address && shipping_phone && payment_select) {
                                    $.ajax({
                                        url: '{{url("/send-mail-confirm-order")}}',
                                        method: 'POST',
                                        data: {
                                            shipping_email: shipping_email,
                                            shipping_name: shipping_name,
                                            shipping_address: shipping_address,
                                            shipping_city: shipping_city,
                                            shipping_ward: shipping_ward,
                                            shipping_province: shipping_province,
                                            shipping_phone: shipping_phone,
                                            shipping_notes: shipping_notes,
                                            order_fee: order_fee,
                                            _token: _token
                                        },
                                        beforeSend: function(){
                                            Swal.fire({
                                                title: 'Please Wait !',
                                                allowOutsideClick: false,
                                                showConfirmButton: false,
                                                didOpen: () => {
                                                    Swal.showLoading()
                                                },
                                            });

                                        },
                                        success: function() {
                                            Swal.fire({
                                                position: 'center',
                                                icon: 'success',
                                                title: 'Your order has been saved',
                                                showConfirmButton: false,
                                                timer: 1500
                                            })
                                            $.ajax({
                                                url: "{{url('/confirm-order')}}",
                                                method: 'POST',
                                                data: {
                                                    shipping_email: shipping_email,
                                                    shipping_name: shipping_name,
                                                    shipping_address: shipping_address,
                                                    shipping_city: shipping_city,
                                                    shipping_province: shipping_province,
                                                    shipping_ward: shipping_ward,
                                                    shipping_phone: shipping_phone,
                                                    shipping_notes: shipping_notes,
                                                    payment_select: payment_select,
                                                    order_fee: order_fee,
                                                    order_coupon: order_coupon,
                                                    _token: _token
                                                },
                                                success: function() {
                                                    if (payment_select == 1) {
                                                        document.getElementById("shipping_method").innerHTML = 'COD';
                                                    } else if (payment_select == 2) {
                                                        document.getElementById("shipping_method").innerHTML = 'MOMO';
                                                    } else {
                                                        document.getElementById("shipping_method").innerHTML = 'Unidentified';
                                                    }
                                                    $("#OrderBill").modal("toggle");

                                                    $('#closeBill').click(function() {
                                                        window.location.href = "{{ URL::to('/profile/order')}}";
                                                    });
                                                }
                                            });

                                        }
                                    });
                                } else {

                                    Swal.fire(
                                        'Oops!',
                                        'Something went wrong!! Make sure you have fill all field',
                                        'warning'
                                    )
                                }
                            } else {
                                Swal.fire(
                                    'Oops!',
                                    'Something went wrong!! Calculate your address delivery fee',
                                    'warning'
                                )
                            }
                        }
                    });
                    
                }else if($(this).attr('name') =='momo'){    //MOMO
                    Swal.fire({
                    title: 'Ready to submit your order?',
                    text: "Check your information and your shopping cart carefully",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, submit now!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var shipping_email = $('.shipping_email').val();
                        var shipping_name = $('.shipping_name').val();
                        var shipping_address = $('#specific_address').text().trim();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_notes = $('.shipping_notes').val();
                        var payment_select = $('.payment_select').val();
                        var order_fee = $('.order_fee').val();
                        var order_coupon = $('.order_coupon').val();
                        var total_momo = $('.total_momo').val();
                        var _token = $('input[name="_token"]').val();

                        if (order_fee) {
                            if (shipping_email && shipping_name && shipping_address && shipping_phone && payment_select) {
                                $.ajax({
                                    url: '{{url("/momo-payment")}}',
                                    method: 'POST',
                                    data: {
                                        shipping_email: shipping_email,
                                        shipping_name: shipping_name,
                                        shipping_address: shipping_address,
                                        shipping_phone: shipping_phone,
                                        shipping_notes: shipping_notes,
                                        total_momo: total_momo,
                                        _token: _token
                                    },
                                    beforeSend: function(){
                                        Swal.fire({
                                            title: 'Doing your payment, please check it!',
                                            allowOutsideClick: false,
                                            showConfirmButton: false,
                                            didOpen: () => {
                                                Swal.showLoading()
                                            },
                                        });

                                    },
                                    success: function(data) {
                                        // console.log(data);
                                        location.replace(data);
                                    }
                                });
                            } else {

                                Swal.fire(
                                    'Oops!',
                                    'Something went wrong!! Make sure you have fill all field',
                                    'warning'
                                )
                            }
                        } else {
                            Swal.fire(
                                'Oops!',
                                'Something went wrong!! Calculate your address delivery fee',
                                'warning'
                            )
                        }
                    }
                });
                }else{
                    Swal.fire(
                        'Oops!',
                        'You have not choose your payment gateway',
                        'warning'
                    )
                }

            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#sort').on('change', function() {
                var url = $(this).val();
                if (url) {
                    window.location = url;
                }
                return false;
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.check_received').click(function() {
                Swal.fire({
                    title: 'Have you received the products?',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, complete my order'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var order_code = $('.order_code').val();
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: "{{url('/complete-order')}}",
                            method: 'POST',
                            data: {
                                _token: _token,
                                order_code: order_code
                            },
                            success: function() {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Your order has been completed',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1800);

                            }
                        });

                    }
                });

            });
        });
    </script>

    @if(session()->has('signature'))
        <script type="text/javascript">
            window.onload = function(){
                var paid = document.getElementById("paid");
                if (paid.style.display === "none") {
                    paid.style.display = "block"
                }
                document.getElementById('automate_check_out').click();
                }
        </script>
    @endif 

    @if(Route::currentRouteNamed('check-out'))
    <script>
        $(document).ready(function() {
            $('.save_change_address').click(function() {
                setTimeout(function() {
                var city = $('input[name="city_address"]').val();
                var province = $('input[name="province_address"]').val();
                var ward = $('input[name="ward_address"]').val();
                var _token = $('input[name="_token"]').val();
                if (city && province && ward) {
                    $.ajax({
                        url: '{{url("/calculate-fee")}}',
                        method: 'POST',
                        data: {
                            city: city,
                            province: province,
                            ward: ward,
                            _token: _token
                        },
                        success: function(data) {
                            location.reload();
                        }
                    });
                }
            }, 1000);
            })
        })
    </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#automate_check_out').click(function() {
                var shipping_email = $('.shipping_email').val();
                var shipping_name = $('.shipping_name').val();
                var shipping_address = $('#specific_address').text().trim();
                var shipping_city = $('input[name="city_name"]').val();
                var shipping_province = $('input[name="province_name"]').val();
                var shipping_ward = $('input[name="ward_name"]').val();
                var shipping_phone = $('.shipping_phone').val();
                var shipping_notes = $('.shipping_notes').val();
                var payment_select = $('input[name="payment_select"]:checked').val();
                var order_fee = $('.order_fee').val();
                var order_coupon = $('.order_coupon').val();
                var _token = $('input[name="_token"]').val();

                if (order_fee) {
                    if (shipping_email && shipping_name && shipping_address && shipping_phone && payment_select) {
                        $.ajax({
                            url: '{{url("/send-mail-confirm-order")}}',
                            method: 'POST',
                            data: {
                                shipping_email: shipping_email,
                                shipping_name: shipping_name,
                                shipping_address: shipping_address,
                                shipping_phone: shipping_phone,
                                shipping_notes: shipping_notes,
                                order_fee: order_fee,
                                _token: _token
                            },
                            beforeSend: function(){
                                Swal.fire({
                                    title: 'Please Wait !',
                                    allowOutsideClick: false,
                                    showConfirmButton: false,
                                    didOpen: () => {
                                        Swal.showLoading()
                                    },
                                });

                            },
                            success: function() {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Your order has been saved',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                $.ajax({
                                    url: "{{url('/confirm-order')}}",
                                    method: 'POST',
                                    data: {
                                        shipping_email: shipping_email,
                                        shipping_name: shipping_name,
                                        shipping_address: shipping_address,
                                        shipping_city: shipping_city,
                                        shipping_province: shipping_province,
                                        shipping_ward: shipping_ward,
                                        shipping_phone: shipping_phone,
                                        shipping_notes: shipping_notes,
                                        payment_select: payment_select,
                                        order_fee: order_fee,
                                        order_coupon: order_coupon,
                                        _token: _token
                                    },
                                    success: function() {
                                        if (payment_select == 1) {
                                            document.getElementById("shipping_method").innerHTML = 'COD';
                                        } else if (payment_select == 2) {
                                            document.getElementById("shipping_method").innerHTML = 'MOMO';
                                        } else {
                                            document.getElementById("shipping_method").innerHTML = 'Unidentified';
                                        }
                                        $("#OrderBill").modal("toggle");

                                        $('#closeBill').click(function() {
                                            window.location.href = "{{ URL::to('/profile/order')}}";
                                        });
                                    }
                                });

                            }
                        });
                    } else {

                        Swal.fire(
                            'Oops!',
                            'Something went wrong!! Make sure you have fill all field',
                            'warning'
                        )
                    }
                } else {
                    Swal.fire(
                        'Oops!',
                        'Something went wrong!! Calculate your address delivery fee',
                        'warning'
                    )
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            window.setTimeout(function() {
                $("#alertMessage").fadeOut(1000)
            }, 2000);
        });
    </script>
</body>

</html>