@extends('components.public_layout.layout')
@section('content')
@extends('components.alert.alert')

<div class="content">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="mb-4">
                    <h3>{{ __('public/register.Register to') }} <strong style="color: green;">{{ __('public/register.Zay Shop') }}</strong></h3>
                </div>
                <form action="{{URL::to('/register-account')}}" method="post">
                    @csrf
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control @error('account_name')is-invalid @enderror" id="name" placeholder="Enter your name" name="account_name" value="{{ old('account_name') }}">
                        <label for="name">{{ __('public/register.Full name') }}</label>
                        @error('account_name')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control @error('account_email')is-invalid @enderror" id="email" placeholder="Enter email" name="account_email" value="{{ old('account_email') }}">
                        <label for="email">{{ __('public/register.Email') }}</label>
                        @error('account_email')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control @error('account_phone')is-invalid @enderror" id="phone" placeholder="Enter phone" name="account_phone" value="{{ old('account_phone') }}">
                        <label for="phone">{{ __('public/register.Phone') }}</label>
                        @error('account_phone')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="password" class="form-control @error('account_password')is-invalid @enderror" id="password" placeholder="Enter password" name="account_password">
                        <label for="password">{{ __('public/register.Password') }}</label>
                        @error('account_password')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="password" class="form-control @error('account_cfpassword')is-invalid @enderror" id="cfpassword" placeholder="Enter confirm password" name="account_cfpassword">
                        <label for="cfpassword">{{ __('public/register.Confirm Password') }}</label>
                        @error('account_cfpassword')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="g-recaptcha" data-sitekey="{{ config('services.captcha.captcha_key') }}"></div>
                    <br />
                    @if($errors->has('g-recaptcha-response'))
                    <span class="invalid-feedback" style="display:block">
                        <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                    </span>
                    @endif

                    <input type="submit" value="{{ __('public/register.Sign In') }}" class="btn btn-outline-success">

                </form>
                <span class="d-block text-left my-4 text-muted"> {{ __('public/register.Already have account?') }} <a class="text-decoration-none" href="{{URL::to('/login')}}"> {{ __('public/register.Log in now') }}</a></span>

            </div>

        </div>
    </div>
</div>
@endsection