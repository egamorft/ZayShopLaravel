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
                <div class="h4 text-white">{{ __('profile/Chgpwd.Account') }}</div>
                <ul>
                    <li class="{{ Route::currentRouteNamed('profile.account') ? 'active' : '' }}">
                        <a href=" {{URL::to('/profile/account')}}" class="text-decoration-none d-flex align-items-start">
                        <div class="far pt-2 me-3">
                            <i class="fa-solid fa-user fa-xl"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="link">{{ __('profile/Chgpwd.My Profile') }}</div>
                            <div class="link-desc">{{ __('profile/Chgpwd.Change your profile') }}</div>
                        </div>
                        </a>
                    </li>
                    <li class="{{ Route::currentRouteNamed('profile.chgpwd') ? 'active' : '' }}">
                        <a href=" {{URL::to('/profile/chgpwd')}}" class="text-decoration-none d-flex align-items-start">
                        <div class="fas pt-2 me-3">
                            <i class="fa-solid fa-lock fa-xl"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="link">{{ __('profile/Chgpwd.Password') }}</div>
                            <div class="link-desc">{{ __('profile/Chgpwd.Change your password') }}</div>
                        </div>
                        </a>
                    </li>
                    <li class="{{ Route::currentRouteNamed('profile.address') ? 'active' : '' }}">
                        <a href=" {{URL::to('/profile/address')}}" class="text-decoration-none d-flex align-items-start">
                        <div class="fas pt-2 me-3">
                            <i class="fa-solid fa-address-card fa-xl"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="link">Address</div>
                            <div class="link-desc">Change your address</div>
                        </div>
                        </a>
                    </li>
                    <li class="{{ Route::currentRouteNamed('profile.order') ? 'active' : '' }}">
                        <a href=" {{URL::to('/profile/order')}}" class="text-decoration-none d-flex align-items-start">
                        <div class="fas pt-2 me-3">
                            <i class="fa-solid fa-box fa-xl"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="link">{{ __('profile/Chgpwd.My Order') }}</div>
                            <div class="link-desc">{{ __('profile/Chgpwd.View & Manage your orders') }}</div>
                        </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @if(Session::get('account_id'))
        <div class="col-lg-9 my-lg-0 my-1">
            <div id="main-content" class="bg-white border row">
                <div class="col-md-12 border-right">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="text-right">My address</h5>
                        <button class="btn btn-outline-success">Add new address</button>
                    </div>
                    <hr class="mb-2">
                    <h5>Address list</h5>
                    <div id="vue">
                        <profile_address></profile_address>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-lg-9 my-lg-0 my-1">
            <center class="m-5">
                <a class="nav-icon position-relative text-decoration-none text-dark" href="{{URL::to('/login')}}">
                    {{ __('profile/Chgpwd.You have to') }}
                    <i class="fa fa-fw fa-lock text-dark mr-3"></i>
                    {{ __('profile/Chgpwd.Login') }}
                </a>
            </center>
        </div>
        @endif
    </div>

</div>
<!-- End Content -->


@endsection