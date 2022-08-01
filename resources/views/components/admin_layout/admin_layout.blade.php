<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @if (Route::currentRouteNamed('category') 
            || Route::currentRouteNamed('subcategory') 
            || Route::currentRouteNamed('coupon') 
            || Route::currentRouteNamed('slider'))
        <meta name="csrf-token" content="{{csrf_token()}}">
        <script>
            window.Laravel = {
                csrfToken: '{{csrf_token()}}'
            }
        </script>
    @endif
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('public/backend/images/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('public/backend/images/favicon.png')}}">
    <title>
        Admin | Dashboard
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{asset('public/backend/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('public/backend/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{asset('public/backend/css/material-dashboard.css?v=3.0.2')}}" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-200">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs
         border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5
                 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav">
            </i>
            <a class="navbar-brand m-0" target="_blank">
                <img src="{{asset('public/backend/images/logo-ct.png')}}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold text-white">
                    Hello
                    <?php

                    $name = Session::get('admin_name');

                    if ($name) {
                        echo  $name;
                    }
                    ?>
                </span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white 
                        {{ Route::currentRouteNamed('dashboard') ? 'bg-gradient-primary' : '' }}" href="{{URL::to('/dashboard')}}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">
                                dashboard
                            </i>
                        </div>
                        <span class="nav-link-text ms-1">
                            Dashboard
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white 
                        {{ Route::currentRouteNamed('category') ? 'bg-gradient-primary' : '' }}" href="{{URL::to('/show-category')}}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">
                                table_view
                            </i>
                        </div>
                        <span class="nav-link-text ms-1">
                            Category
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white 
                        {{ Route::currentRouteNamed('subcategory') ? 'bg-gradient-primary' : '' }}" href="{{URL::to('/show-sub-category')}}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">
                                receipt_long
                            </i>
                        </div>
                        <span class="nav-link-text ms-1">
                            SubCategory
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white 
                        {{ Route::currentRouteNamed('product') ? 'bg-gradient-primary' : '' }}" href="{{URL::to('/show-product')}}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">
                                view_in_ar
                            </i>
                        </div>
                        <span class="nav-link-text ms-1">
                            Product
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white 
                        {{ Route::currentRouteNamed('coupon') ? 'bg-gradient-primary' : '' }}" href="{{URL::to('/show-coupon')}}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">
                                format_textdirection_r_to_l
                            </i>
                        </div>
                        <span class="nav-link-text ms-1">
                            Coupon
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white 
                        {{ Route::currentRouteNamed('delivery') ? 'bg-gradient-primary' : '' }}" href="{{URL::to('/delivery')}}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">
                                local_shipping
                            </i>
                        </div>
                        <span class="nav-link-text ms-1">
                            Delivery
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white 
                        {{ Route::currentRouteNamed('order') ? 'bg-gradient-primary' : '' }}" href="{{URL::to('/order')}}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">
                                list_alt
                            </i>
                        </div>
                        <span class="nav-link-text ms-1">
                            Order
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white 
                        {{ Route::currentRouteNamed('slider') ? 'bg-gradient-primary' : '' }}" href="{{URL::to('/slider')}}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">
                                slideshow
                            </i>
                        </div>
                        <span class="nav-link-text ms-1">
                            Slider
                        </span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">
                        Account pages
                    </h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white ">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">
                                person
                            </i>
                        </div>
                        <span class="nav-link-text ms-1">
                            Profile
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="{{URL::to('/logout')}}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">
                                login
                            </i>
                        </div>
                        <span class="nav-link-text ms-1">
                            Log out
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">
                                    <?php
                                    if ($name) {
                                        echo  $name;
                                    }
                                    ?>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        @yield('alert_content')
        @yield('admin_content')
    </main>
    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="material-icons py-2">
                settings
            </i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">
                        Material UI Configurator
                    </h5>
                    <p>
                        See our dashboard options.
                    </p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="material-icons">
                            clear
                        </i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">
                        Sidebar Colors
                    </h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)">
                        </span>
                        <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)">
                        </span>
                        <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)">
                        </span>
                        <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)">
                        </span>
                        <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)">
                        </span>
                        <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)">
                        </span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">
                        Sidenav Type
                    </h6>
                    <p class="text-sm">
                        Choose between 2 different sidenav types.
                    </p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">
                        Dark
                    </button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">
                        Transparent
                    </button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">
                        White
                    </button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">
                    You can change the sidenav type just on desktop view.
                </p>
                <!-- Navbar Fixed -->
                <div class="mt-3 d-flex">
                    <h6 class="mb-0">
                        Navbar Fixed
                    </h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-3">
                <div class="mt-2 d-flex">
                    <h6 class="mb-0">
                        Light / Dark
                    </h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <!-- <script src="{{asset('public/backend/js/core/popper.min.js')}}"></script> --> 
    @if (Route::currentRouteNamed('category') 
            || Route::currentRouteNamed('subcategory') 
            || Route::currentRouteNamed('coupon') 
            || Route::currentRouteNamed('slider'))
    <script src="{{url('public/js/app.js')}}"></script>
    @endif
    <script src="{{asset('public/frontend/js/sweetalert.js')}}"></script>
    <script src="{{asset('public/backend/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/backend/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('public/backend/js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{asset('public/backend/js/material-dashboard.min.js?v=3.0.2')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>


    @if(Route::currentRouteNamed('dashboard'))
    <script>
        $(function() {
            $("#datepicker1").datepicker({
                dateFormat: 'yy-mm-dd',
                yearRange: '2020:2030',
                maxDate: new Date()
            });
        });

        $(function() {
            $("#datepicker2").datepicker({
                dateFormat: 'yy-mm-dd',
                yearRange: '2020:2030',
                maxDate: new Date()
            });
        });
    </script>

    <script>
        var donut = Morris.Donut({
            element: 'donut',
            resize: true,
            colors: [
                '#1EDFD6',
                '#E88134',
                '#B775E5',
                '#EC4040'
            ],
            data: [
                {label: "Product", value: <?php echo $product_donut ?>},
                {label: "Order", value: <?php echo $order_donut ?>},
                {label: "Customer", value: <?php echo $account_donut ?>},
                {label: "Coupon", value: <?php echo $coupon_donut ?>},
            ]
        });
    </script>

    <script>
        $(document).ready(function() {

            chart30daysorder();

            var chart = new Morris.Line({

                element: 'chart',
                //option chart
                gridTextColor: 'white',
                lineColors: ['#107321', '#033D68', '#248897', '#A4ADD3', 'white'],
                parsetime: false,
                hideHover: 'auto',
                xkey: 'period',
                ykeys: ['order', 'sales', 'profit', 'quantity'],
                labels: ['Order', 'Sales', 'Profit', 'Quantity']
            });

            function chart30daysorder() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{URL('/days-order')}}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        chart.setData(data);
                    }
                });
            }

            $('.dashboard-filter').change(function() {
                var dashboard_value = $(this).val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{URL('/dashboard-filter')}}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        dashboard_value: dashboard_value,
                        _token: _token
                    },
                    success: function(data) {
                        chart.setData(data);
                    }
                });
            });


            $('#btn-dashboard-filter').click(function() {
                var _token = $('input[name="_token"]').val();
                var from_date = $('#datepicker1').val();
                var to_date = $('#datepicker2').val();

                if(from_date == '' || to_date == ''){
                    Swal.fire({
                        icon: 'warning',
                        title: 'From date or End date is null'
                    })
                }else{
                if(from_date <= to_date){
                    $.ajax({
                        url: "{{URL('/filter-by-date')}}",
                        method: "POST",
                        dataType: "JSON",
                        data: {
                            from_date: from_date,
                            to_date: to_date,
                            _token: _token
                        },
                        success: function(data) {
                            chart.setData(data);
                        }
                    });
                }else{
                    Swal.fire({
                        icon: 'question',
                        title: 'From date is after End date?'
                    })
                }
                }
            });
        });
    </script>
    @endif
    <script>
        function preview() {
            frame.src = URL.createObjectURL(event.target.files[0]);
            var file = document.getElementById('productImage')
            var bodyFormData = new FormData();
            bodyFormData.append('product_image', file.files[0]);

        }
    </script>

    @if (Route::currentRouteNamed('delivery') )
    <script>
        $(document).ready(function() {
            fetch_delivery();

            function fetch_delivery() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url("/select-feeship")}}',
                    method: 'POST',
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        $('#load_delivery').html(data);
                    }
                });
            }
            $(document).on('blur', '.fee_feeship_edit', function() {
                var feeship_id = $(this).data('feeship_id');
                var fee_value = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url("/update-delivery")}}',
                    method: 'POST',
                    data: {
                        feeship_id: feeship_id,
                        fee_value: fee_value,
                        _token: _token
                    },
                    success: function(data) {
                        fetch_delivery();
                    }
                });
            });
            $('.add_delivery').click(function() {
                var city = $('.city').val();
                var province = $('.province').val();
                var wards = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                var fee_ship = $('.fee_ship').val();
                if (city == '' || province == '' || wards == '' || fee_ship == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'You must fill all field',
                        showConfirmButton: false,
                        timer: 1800
                    })
                } else {
                    if (fee_ship > 0) {
                        $.ajax({
                            url: '{{url("/insert-delivery")}}',
                            method: 'POST',
                            data: {
                                city: city,
                                province: province,
                                _token: _token,
                                wards: wards,
                                fee_ship: fee_ship
                            },
                            success: function(data) {
                                fetch_delivery();
                                location.reload();
                            },
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Delivery fee must > 0'
                        })
                    }
                }
            });
            $('.choose').change(function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                // alert(action);
                // alert(matp);
                // alert(_token);
                if (action == 'city') {
                    result = 'province';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: '{{url("/select-delivery")}}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        })
    </script>
    @endif
    <script>
        $(document).ready(function() {
            $('.choose').change(function() {
                var action = $(this).attr('id');
                var cate_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                if (action == 'category') {
                    result = 'subcategory';
                }
                $.ajax({
                    url: '{{url("/select-category")}}',
                    method: 'POST',
                    data: {
                        action: action,
                        cate_id: cate_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        })
    </script>
    <script type="text/javascript">
        ClassicEditor
            .create(document.querySelector('#ckeditorAdd'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#ckeditorAdd1'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        $(document).ready(function() {
            window.setTimeout(function() {
                $("#alertMessage").fadeOut(1000)
            }, 2000);
        });
    </script>
    <script>
        $('.order_details').change(function() {
            var order_status = $(this).val();
            var order_id = $(this).children(":selected").attr("id");
            var _token = $("input[name='_token']").val();

            // lay so luong
            quantity = [];
            $("input[name='product_sales_quantity']").each(function() {
                quantity.push($(this).val());
            });

            //lay id
            order_product_id = [];
            $("input[name='order_product_id']").each(function() {
                order_product_id.push($(this).val());
            });
            j = 0;
            if (order_status == 2) {
                for (i = 0; i < order_product_id.length; i++) {
                    //So luong order
                    var order_qty = $('.order_qty_' + order_product_id[i]).val();
                    //So luong trong kho
                    var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();
                    if (parseInt(order_qty) > parseInt(order_qty_storage)) {
                        j = j + 1;
                        if (j == 1) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Product in stock not enough',
                                showConfirmButton: false,
                                timer: 1800
                            })
                        }
                        $('.color_qty_' + order_product_id[i]).css('background', '#C11B17');
                    }
                }
                if (j == 0) {
                    $.ajax({
                        url: '{{url("/send-mail-delivery")}}',
                        method: 'POST',
                        data: {
                            order_id: order_id,
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
                        success: function(){
                            Swal.fire({
                                icon: 'success',
                                title: 'Delivering this order',
                                showConfirmButton: false,
                                timer: 1800
                            })
                        }
                    });
                }
            } else if (order_status == 3) {
                Swal.fire({
                    icon: 'success',
                    title: 'This order has been canceled',
                    showConfirmButton: false,
                    timer: 4800
                })
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Not handle yet',
                    showConfirmButton: false,
                    timer: 4800
                })
            }
            if (j == 0) {
                $.ajax({
                    url: "{{url('/update-order-qty')}}",
                    method: 'POST',
                    data: {
                        _token: _token,
                        order_status: order_status,
                        order_id: order_id,
                        quantity: quantity,
                        order_product_id: order_product_id
                    },
                    success: function(data) {
                        setTimeout(function() { // wait for 2 secs(2)
                            location.reload(); // then reload the page.(3)
                        }, 5000);
                    }
                });

            }

        });
    </script>
    <script>
        $('.update_quantity_order').click(function() {
            var order_product_id = $(this).data('product_id');
            var order_qty = $('.order_qty_' + order_product_id).val();
            var order_code = $('.order_code').val();
            var _token = $('input[name=_token]').val();
            $.ajax({
                url: "{{url('/update-qty')}}",
                method: 'POST',
                data: {
                    _token: _token,
                    order_qty: order_qty,
                    order_code: order_code,
                    order_product_id: order_product_id
                },
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Update product quantity',
                        showConfirmButton: false,
                        timer: 1800
                    })
                    setTimeout(function() { // wait for 2 secs(2)
                        location.reload(); // then reload the page.(3)
                    }, 2000);
                }
            });
        });
    </script>
    <script>
        $(function(){
            $('#myFilter').keyup(function() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myFilter");
                filter = input.value.toUpperCase();
                table = document.getElementById("filterTable");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }       
                }
            });
        });
    </script>
    <script>
            $(document).ready(function() {
                $('#order_sort').on('change', function() {
                    var url = $(this).val();
                    if (url) {
                        window.location = url;
                    }
                    return false;
                });
            });

            $(document).ready(function() {
                $('#order_filter').on('change', function() {
                    var url = $(this).val();
                    if (url) {
                        window.location = url;
                    }
                    return false;
                });
            });

            $(document).ready(function() {
                $('#product_sort').on('change', function() {
                    var url = $(this).val();
                    if (url) {
                        window.location = url;
                    }
                    return false;
                });
            });

            $(document).ready(function() {
                $('#product_filter_category').on('change', function() {
                    var url = $(this).val();
                    if (url) {
                        window.location = url;
                    }
                    return false;
                });
            });
            
            $(document).ready(function() {
                $('#product_filter_subcategory').on('change', function() {
                    var url = $(this).val();
                    if (url) {
                        window.location = url;
                    }
                    return false;
                });
            });

            $(document).ready(function() {
                $('#product_filter_status').on('change', function() {
                    var url = $(this).val();
                    if (url) {
                        window.location = url;
                    }
                    return false;
                });
            });
    </script>
</body>

</html>