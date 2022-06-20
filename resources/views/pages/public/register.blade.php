@extends('layout')
@section('content')

<!-- Alert -->
@if(session()->has('message'))
<div class="container">
    <div class="row">
        <div class="col-9"></div>
        <div class="col-sm-3">
            <div id="alertMessage" class="alert alert-success">
                <strong>Success! </strong>
                {{session()->get('message')}}
            </div>
        </div>
    </div>
</div>
</div>
<?php
Session::put('message', null);
?>
@elseif(session()->has('error'))
<div class="container">
    <div class="row">
        <div class="col-9"></div>
        <div class="col-sm-3">
            <div id="alertMessage" class="alert alert-danger">
                <strong>Error! </strong>
                {{session()->get('error')}}
            </div>
        </div>
    </div>
</div>
</div>
<?php
Session::put('error', null);
?>
@endif
<!-- End Alert -->

<div class="content">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="mb-4">
                    <h3>Register to <strong style="color: green;">Zay Shop</strong></h3>
                </div>
                <form action="{{URL::to('/register-account')}}" method="post">
                    @csrf
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="name" placeholder="Enter your name" name="account_name">
                        <label for="name">Full name</label>
                        @error('account_name')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="email" placeholder="Enter email" name="account_email">
                        <label for="email">Email</label>
                        @error('account_email')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="account_phone">
                        <label for="phone">Phone</label>
                        @error('account_phone')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="account_password">
                        <label for="password">Password</label>
                        @error('account_password')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="password" class="form-control" id="password" placeholder="Enter confirm password" name="account_cfpassword">
                        <label for="password">Confirm Password</label>
                        @error('account_cfpassword')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                    <br />
                    @if($errors->has('g-recaptcha-response'))
                    <span class="invalid-feedback" style="display:block">
                        <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                    </span>
                    @endif


                    <input type="submit" value="Sign In" class="btn btn-outline-success">

                </form>
                <span class="d-block text-left my-4 text-muted"> Already have account? <a href="login"> Log in now</a></span>

            </div>

        </div>
    </div>
</div>
@endsection