@extends('components.public_layout.layout')
@section('content')
@extends('components.alert.alert')

<div class="content">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="mb-4">
                    <h3>Set your new password <strong style="color: green;">Zay Shop</strong></h3>
                </div>
                <form action="{{URL::to('/set-new-password')}}" method="post">
                    @csrf
                    <input type="hidden" value="{{$verify_code}}" name="verify_code">
                    <div class="form-floating mb-3 mt-3">
                        <input type="password" class="form-control @error('account_password')is-invalid @enderror" id="password" placeholder="Enter password" name="account_password">
                        <label for="password">New Password</label>
                        @error('account_password')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="password" class="form-control @error('account_cfpassword')is-invalid @enderror" id="password" placeholder="Enter confirm password" name="account_cfpassword">
                        <label for="password">Confirm Password</label>
                        @error('account_cfpassword')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                    @if($errors->has('g-recaptcha-response'))
                    <span class="invalid-feedback" style="display:block">
                        <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                    </span>
                    @endif
                    <br>
                    <input type="submit" value="Set password" class="btn btn-outline-success">

                </form>

            </div>

        </div>
    </div>
</div>
@endsection