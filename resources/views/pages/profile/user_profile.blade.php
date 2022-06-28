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
                        <a href=" {{URL::to('/profile/account')}}" class="text-decoration-none d-flex align-items-start">
                        <div class="far fa-user pt-2 me-3"></div>
                        <div class="d-flex flex-column">
                            <div class="link">My Profile</div>
                            <div class="link-desc">Change your profile</div>
                        </div>
                        </a>
                    </li>
                    <li class="{{ Route::currentRouteNamed('profile.order') ? 'active' : '' }}"">
                        <a href=" {{URL::to('/profile/order')}}" class="text-decoration-none d-flex align-items-start">
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
            <div id="main-content" class="bg-white border row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    </div>
                </div>
                <div class="col-md-9 border-right">
                    <form action="{{#}}" method="POST">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile Settings</h4>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Full Name</label>
                                    <input type="text" class="form-control" value="<?php echo Session::get('account_name') ?>">
                                </div>

                                <div class="col-md-12"><label class="labels">Email</label>
                                    <input type="text" class="form-control" value="<?php echo Session::get('account_email') ?> ">
                                </div>

                                <div class="col-md-12"><label class="labels">Phone Number</label>
                                    <input type="text" class="form-control" value="<?php echo Session::get('account_phone') ?>">
                                </div>
                            </div>
                            <div class="mt-5 text-center">
                                <button class="btn btn-primary profile-button" type="button">Save Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End Content -->


@endsection