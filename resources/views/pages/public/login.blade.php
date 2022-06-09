@extends('layout')
@section('content')

<div class="content">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="mb-4">
                    <h3>Sign In to <strong style="color: green;">Zay Shop</strong></h3>
                </div>
                <form action="#" method="post">
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="password" placeholder="Enter password" name="password">
                        <label for="password">Password</label>
                    </div>

                    <input type="submit" value="Log In" class="btn btn-outline-success">

                </form>
                <span class="d-block text-left my-4 text-muted"> Don't have account? Register <a href="register"> Here</a></span> 
                <span class="d-block text-left my-4 text-muted"> or sign in with</span>

                <div class="social-login">
                    <a href="#" class="facebook">
                        <i class="fa-brands fa-facebook fa-2xl"></i>
                    </a>
                    <a href="#" class="twitter" style="margin-left: 50px;">
                        <i class="fa-brands fa-google fa-2xl"></i>
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection