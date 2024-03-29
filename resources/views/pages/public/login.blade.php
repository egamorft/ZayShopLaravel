@extends('components.public_layout.layout')
@section('content')
@extends('components.alert.alert')

<div class="content">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="mb-4">
                    <h3>{{ __('public/login.Sign In to') }} <strong style="color: green;">{{ __('public/login.Zay Shop') }}</strong></h3>
                </div>
                <form action="{{URL::to('/login-account')}}" method="post">
                    @csrf
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control @error('account_email')is-invalid @enderror" id="email" placeholder="Enter your email" name="account_email" value="{{ old('account_email') }}">
                        <label for="email">{{ __('public/login.Email') }}</label>
                        @error('account_email')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="password" class="form-control @error('account_password')is-invalid @enderror" id="password" placeholder="Enter password" name="account_password">
                        <label for="password">{{ __('public/login.Password') }}</label>
                        @error('account_password')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>

                    <input type="submit" value="{{ __('public/login.Log In') }}" class="btn btn-outline-success">

                </form>
                @if($errors->any() || Session::get('error'))
                <span class="d-block text-left my-4"> {{ __('public/login.You forgot your password?') }}<a class="text-decoration-none" href="{{URL::to('/reset-password')}}"> {{ __('public/login.Reset now') }}</a></span>
                @endif
                <span class="d-block text-left my-4"> {{ __("public/login.Don't have account? Register") }} <a class="text-decoration-none" href="{{URL::to('/register')}}"> {{ __('public/login.Here') }}</a></span>
                <span class="d-block text-left my-4"> {{ __('public/login.or sign in with') }}</span>

                <div class="social-login">
                    <a href="{{URL::to('/login-facebook')}}" class="facebook">
                        <i class="fa-brands fa-facebook fa-2xl"></i>
                    </a>
                    <a href="{{URL::to('/login-google')}}" class="twitter" style="margin-left: 50px;">
                        <i class="fa-brands fa-google fa-2xl"></i>
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection