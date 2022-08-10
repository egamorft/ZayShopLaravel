@extends('components.public_layout.layout')
@section('content')
@extends('components.alert.alert')

<div class="content">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="mb-4">
                    <h3>{{ __('profile/ResetPassword.Reset your password') }} <strong style="color: green;">{{ __('profile/ResetPassword.Zay Shop') }}</strong></h3>
                </div>
                <form action="{{URL::to('/confirm-reset-password')}}" method="post">
                    @csrf
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control @error('account_email')is-invalid @enderror" id="email" placeholder="Enter your email" name="account_email" value="{{ old('account_email') }}">
                        <label for="email">{{ __('profile/ResetPassword.Enter your email') }}</label>
                        @error('account_email')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="g-recaptcha" data-sitekey="{{ config('services.captcha.captcha_key') }}"></div>
                    @if($errors->has('g-recaptcha-response'))
                    <span class="invalid-feedback" style="display:block">
                        <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                    </span>
                    @endif
                    <br>
                    <input type="submit" value="{{ __('profile/ResetPassword.Reset password') }}" class="btn btn-outline-success">

                </form>

            </div>

        </div>
    </div>
</div>
@endsection