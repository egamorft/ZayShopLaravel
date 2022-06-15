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


<main class="container">
    <div class="py-5 text-center">
        <h2>Checkout form</h2>
    </div>
    <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Check your cart</span>
                <span class="badge bg-primary rounded-pill">{{Cart::count()}}</span>
            </h4>
            <ul class="list-group mb-3">
                <?php
                $content = Cart::content();
                ?>
                @foreach($content as $value)
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">{{$value->name}}</h6>
                        <small class="text-muted">{{$value->qty}}</small>
                    </div>
                    <span class="text-muted">{{number_format($value->price, 0, ',', '.').' '.'đ'}}</span>
                </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between">
                    <span>Sub Total</span>
                    <strong>{{Cart::subtotal(0 , ',' , '.').' '.'đ'}}</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-danger">
                        <h6 class="my-0">Tax</h6>
                        <small>10% cart</small>
                    </div>
                    <span class="text-danger">{{Cart::tax(0 , ',' , '.').' '.'đ'}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                        <h6 class="my-0">Promo code</h6>
                        <small>SALE500</small>
                    </div>
                    <span class="text-success">{{Cart::discount(0 , ',' , '.').' '.'đ'}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total</span>
                    <strong>{{Cart::total(0 , ',' , '.').' '.'đ'}}</strong>
                </li>
            </ul>


        </div>
        <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Billing address</h4>
            <form method="POST" action="">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="fullName" class="form-label">Full name</label>
                        <input type="text" class="form-control" id="fullName" value="{{Session::get('account_name')}}">
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" class="form-control" id="email" value="{{Session::get('account_email')}}">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="city" class="form-label">City</label>
                        <select class="form-select" id="city" required>
                            <option value="">Choose...</option>
                            <option>India</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="state" class="form-label">Province</label>
                        <select class="form-select" id="state" required>
                            <option value="">Choose...</option>
                            <option>Delhi</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="state" class="form-label">Wards</label>
                        <select class="form-select" id="state" required>
                            <option value="">Choose...</option>
                            <option>Delhi</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Plaza street" required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <h4 class="mb-3">Payment</h4>

                <div class="my-3">
                    <div class="form-check">
                        <input id="cod" name="paymentMethod" type="radio" class="form-check-input" checked>
                        <label class="form-check-label" for="cod">COD</label>
                    </div>
                    <div class="form-check">
                        <input id="paypal" name="paymentMethod" type="radio" class="form-check-input">
                        <label class="form-check-label" for="paypal">Paypal</label>
                    </div>
                </div>

                <hr class="my-4">

                <button class="w-100 btn btn-danger btn-lg" type="submit">Continue to checkout</button>
            </form>
            <hr class="my-4">
        </div>
    </div>
</main>

@endsection