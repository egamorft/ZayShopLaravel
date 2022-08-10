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
                <div class="h4 text-white">{{ __('profile/UserProfile.Account') }}</div>
                <ul>
                    <li class="{{ Route::currentRouteNamed('profile.account') ? 'active' : '' }}"">
                        <a href=" {{URL::to('/profile/account')}}" class="text-decoration-none d-flex align-items-start">
                        <div class="far pt-2 me-3">
                            <i class="fa-solid fa-user fa-xl"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="link">{{ __('profile/UserProfile.My Profile') }}</div>
                            <div class="link-desc">{{ __('profile/UserProfile.Change your profile') }}</div>
                        </div>
                        </a>
                    </li>
                    <li class="{{ Route::currentRouteNamed('profile.chgpwd') ? 'active' : '' }}"">
                        <a href=" {{URL::to('/profile/chgpwd')}}" class="text-decoration-none d-flex align-items-start">
                        <div class="fas pt-2 me-3">
                            <i class="fa-solid fa-lock fa-xl"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="link">{{ __('profile/UserProfile.Password') }}</div>
                            <div class="link-desc">{{ __('profile/UserProfile.Change your password') }}</div>
                        </div>
                        </a>
                    </li>
                    <li class="{{ Route::currentRouteNamed('profile.order') ? 'active' : '' }}"">
                        <a href=" {{URL::to('/profile/order')}}" class="text-decoration-none d-flex align-items-start">
                        <div class="fas pt-2 me-3">
                            <i class="fa-solid fa-box fa-xl"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="link">{{ __('profile/UserProfile.My Order') }}</div>
                            <div class="link-desc">{{ __('profile/UserProfile.View & Manage your orders') }}</div>
                        </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @if(Session::get('account_id'))
        <div class="col-lg-9 my-lg-0 my-1">
            <div id="main-content" class="bg-white border row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    </div>
                </div>
                <div class="col-md-9 border-right">
                    <form action="{{URL::to('/save-profile')}}" method="POST">
                        @csrf
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">{{ __('profile/UserProfile.Profile Settings') }}</h4>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">{{ __('profile/UserProfile.Full Name') }}</label>
                                    <input name="account_name" type="text" class="form-control" value="<?php echo Session::get('account_name') ?>">
                                </div>
                                @error('account_name')
                                <span style="color: red">{{$message}}</span>
                                @enderror
                                <input name="account_email_check" type="hidden" class="form-control" value="<?php echo Session::get('account_email') ?>">
                                <div class="col-md-12"><label class="labels">{{ __('profile/UserProfile.Email') }}</label>
                                    <input readonly name="account_email" type="text" class="form-control" value="<?php echo Session::get('account_email') ?>">
                                </div>
                                @error('account_email')
                                <span style="color: red">{{$message}}</span>
                                @enderror

                                <div class="col-md-12"><label class="labels">{{ __('profile/UserProfile.Address') }}</label>
                                    <input name="account_address" type="text" class="form-control" value="<?php echo Session::get('account_address') ?>">
                                </div>

                                <div class="col-md-12"><label class="labels">{{ __('profile/UserProfile.Phone Number') }}</label>
                                    <input name="account_phone" type="text" class="form-control" value="<?php echo Session::get('account_phone') ?>">
                                </div>
                                @error('account_phone')
                                <span style="color: red">{{$message}}</span>
                                @enderror

                            </div>

                            <div class="mt-5 text-center">
                                <input class="btn btn-outline-success" type="submit" value="{{ __('profile/UserProfile.Save Profile') }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @else
        <div class="col-lg-9 my-lg-0 my-1">
            <center class="m-5">
                <a type="button" class="nav-icon position-relative text-decoration-none text-dark" href="{{URL::to('/login')}}">
                    {{ __('profile/UserProfile.You have to') }}
                    <i class="fa fa-fw fa-lock text-dark mr-3"></i>
                    {{ __('profile/UserProfile.Login') }}
                </a>
            </center>
        </div>
        @endif
    </div>

</div>
<!-- End Content -->


@endsection