@extends('layout')
@section('content')

<div class="content">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="mb-4">
                    <h3>Register to <strong style="color: green;">Zay Shop</strong></h3>
                </div>
                <form action="#" method="post">
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone">
                        <label for="phone">Phone</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="password" placeholder="Enter password" name="password">
                        <label for="password">Password</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="cfpassword" placeholder="Enter confirm password" name="cfpassword">
                        <label for="cfpassword">Confirm Password</label>
                    </div>

                    <input type="submit" value="Sign In" class="btn btn-outline-success">

                </form>

            </div>

        </div>
    </div>
</div>
@endsection