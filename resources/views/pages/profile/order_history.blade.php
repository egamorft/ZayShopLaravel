@extends('components.public_layout.layout')
@section('content')
@extends('components.alert.alert')

@section('userDashboard')

<!-- flot charts css-->
<link rel="stylesheet" href="{{asset('public/frontend/css/user-dashboard.css')}}">

@stop
<!-- Start Content -->
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-3 my-lg-0 my-md-1">
            <div id="sidebar" class="bg-green">
                <div class="h4 text-white">Account</div>
                <ul>
                    <li class="{{ Route::currentRouteNamed('profile.account') ? 'active' : '' }}"">
                        <a href="{{URL::to('/profile/account')}}" class="text-decoration-none d-flex align-items-start">
                            <div class="far fa-user pt-2 me-3"></div>
                            <div class="d-flex flex-column">
                                <div class="link">My Profile</div>
                                <div class="link-desc">Change your profile</div>
                            </div>
                        </a>
                    </li>
                    <li class="{{ Route::currentRouteNamed('profile.order') ? 'active' : '' }}"">
                        <a href="{{URL::to('/profile/order')}}" class="text-decoration-none d-flex align-items-start">
                            <div class="fas pt-2 me-3">
                                <i class="fa-solid fa-box fa-xl"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <div class="link">My Order</div>
                                <div class="link-desc">View & Manage your orders</div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9 my-lg-0 my-1">
            <div id="main-content" class="bg-white border">
                <div class="d-flex flex-column">
                    <div class="h5">Hello <?php echo Session::get('account_name'); ?>,</div>
                    <div>Logged in as: <?php echo Session::get('account_email'); ?></div>
                </div>
                <div class="d-flex my-4 flex-wrap">
                    <div class="box me-4 my-1 bg-light">
                        <img src="https://www.freepnglogos.com/uploads/box-png/cardboard-box-brown-vector-graphic-pixabay-2.png" alt="">
                        <div class="d-flex align-items-center mt-2">
                            <div class="tag">Orders placed</div>
                            <div class="ms-auto number">{{$order_count}}</div>
                        </div>
                    </div>
                    <div class="box me-4 my-1 bg-light">
                        <img src="https://www.freepnglogos.com/uploads/shopping-cart-png/shopping-cart-campus-recreation-university-nebraska-lincoln-30.png" alt="">
                        <div class="d-flex align-items-center mt-2">
                            <div class="tag">Items in Cart</div>
                            <div class="ms-auto number">{{Cart::count()}}</div>
                        </div>
                    </div>
                </div>
                <div class="text-uppercase">My recent orders</div>
                @forelse($order_paginate as $od)
                <div class="order my-3 bg-light">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="d-flex flex-column justify-content-between order-summary">
                                <div class="d-flex align-items-center">
                                    <div class="text-uppercase">Order #{{$od->order_code}}</div>
                                    <div class="green-label ms-auto text-uppercase">cod</div>
                                </div>
                                <div class="fs-8">{{$od->created_at}}</div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="d-sm-flex align-items-sm-start justify-content-sm-between">
                                @if($od->order_status == 1)
                                <div class="status">Status : Placed/ Not handle</div>
                                @elseif($od->order_status == 2)
                                <div class="status">Status : Delivering</div>
                                <form>
                                    @csrf
                                    <input type="hidden" value="{{$od->order_code}}" name="order_code" class="order_code">
                                    <input type="button" class="check_received btn btn-outline-success" value="Received"></input>
                                </form>
                                @elseif($od->order_status == 3)
                                <div class="status">Status : Accepting/ Pending</div>
                                @elseif($od->order_status == 4)
                                <div class="status">Status : Completed</div>
                                @endif
                            </div>
                            <div class="progressbar-track">
                                @if($od->order_status == 1)
                                <ul class="progressbar">
                                    <li id="step-1" class="text-muted green">
                                        <span class="fas fa-gift"></span>
                                    </li>
                                    <li id="step-2" class="text-muted">
                                        <span class="fas fa-check"></span>
                                    </li>
                                    <li id="step-4" class="text-muted">
                                        <span class="fas fa-truck"></span>
                                    </li>
                                    <li id="step-5" class="text-muted">
                                        <span class="fas fa-box-open"></span>
                                    </li>
                                </ul>
                                @elseif($od->order_status == 2)
                                <ul class="progressbar">
                                    <li id="step-1" class="text-muted green">
                                        <span class="fas fa-gift"></span>
                                    </li>
                                    <li id="step-2" class="text-muted green">
                                        <span class="fas fa-check"></span>
                                    </li>
                                    <li id="step-4" class="text-muted green">
                                        <span class="fas fa-truck"></span>
                                    </li>
                                    <li id="step-5" class="text-muted">
                                        <span class="fas fa-box-open"></span>
                                    </li>
                                </ul>
                                @elseif($od->order_status == 3)
                                <ul class="progressbar">
                                    <li id="step-1" class="text-muted green">
                                        <span class="fas fa-gift"></span>
                                    </li>
                                    <li id="step-2" class="text-muted green">
                                        <span class="fas fa-check"></span>
                                    </li>
                                    <li id="step-4" class="text-muted">
                                        <span class="fas fa-truck"></span>
                                    </li>
                                    <li id="step-5" class="text-muted">
                                        <span class="fas fa-box-open"></span>
                                    </li>
                                </ul>
                                @elseif($od->order_status == 4)
                                <ul class="progressbar">
                                    <li id="step-1" class="text-muted green">
                                        <span class="fas fa-gift"></span>
                                    </li>
                                    <li id="step-2" class="text-muted green">
                                        <span class="fas fa-check"></span>
                                    </li>
                                    <li id="step-4" class="text-muted green">
                                        <span class="fas fa-truck"></span>
                                    </li>
                                    <li id="step-5" class="text-muted green">
                                        <span class="fas fa-box-open"></span>
                                    </li>
                                </ul>
                                @endif
                                <div id="tracker"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <h4>You have not buying anything</h4>
                @endforelse
            </div>
            {!! $order_paginate->render('components.admin_paginate.admin_pagination')!!}
        </div>
    </div>

</div>
<!-- End Content -->


@endsection