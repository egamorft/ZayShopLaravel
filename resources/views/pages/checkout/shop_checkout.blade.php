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

            <form>
                @if(Session::get('fee'))
                <fieldset disabled>
                    @endif
                    @csrf
                    <div class="col-md">
                        <label for="city" class="form-label">City</label>
                        <select name="city" id="city" class="form-control choose city">
                            <option value="">-----Choose your city-----</option>
                            @foreach($city as $key => $ci)
                            <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md">
                        <label for="state" class="form-label">Province</label>
                        <select name="province" id="province" class="form-control province choose">
                            <option value="">-----Choose your province-----</option>
                        </select>
                    </div>

                    <div class="col-md">
                        <label for="state" class="form-label">Wards</label>
                        <select name="wards" id="wards" class="form-control wards">
                            <option value="">-----Choose your wards-----</option>
                        </select>
                    </div>
                    <hr class="my-4">
                    @if(Session::get('fee'))
                    <div class="col-md">
                        <input type="button" value="Calculate delivery" name="calculate_order" class="w-100 btn btn-dark btn-lg calculate_delivery">
                    </div>
                    @else
                    <div class="col-md">
                        <input type="button" value="Calculate delivery" name="calculate_order" class="w-100 btn btn-primary btn-lg calculate_delivery">
                    </div>
                    @endif
                    <hr class="my-4">
                    @if(Session::get('fee'))
                </fieldset>
                @endif
            </form>
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
                    <strong>{{Cart::pricetotal(0 , ',' , '.').' '.'đ'}}</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-danger">
                        <h6 class="my-0">Tax</h6>
                        <small>10% cart</small>
                    </div>
                    <span class="text-danger">{{Cart::tax(0 , ',' , '.').' '.'đ'}}</span>
                </li>
                @if(Session::get('coupon'))
                @foreach(Session::get('coupon') as $key => $cou)
                @if($cou['coupon_condition']==1)
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                        <h6 class="my-0">Promo code</h6>
                        <small><?php echo '-' . $cou['coupon_number'] . '% cart' ?></small>
                    </div>
                    <span class="text-success">{{Cart::discount(0 , ',' , '.').' '.'đ'}}</span>
                </li>
                @endif
                @endforeach
                @else
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                        <h6 class="my-0">Promo code</h6>
                        <small>NONE</small>
                    </div>
                    <span class="text-success">0 đ</span>
                </li>
                @endif
                @if(Session::get('fee'))
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-danger">
                        <h6 class="my-0">Shipping fee</h6>
                    </div>

                    <span class="text-danger">{{number_format(Session::get('fee'), 0 , ',' , '.')}} đ</span>
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <p>Delete address here</p>
                    <a class="cart_quantity_delete" href="{{url('/del-fee')}}"><i style="color: red; font-size:120% ;" class="fa fa-xmark"></i></a>
                </li>
                <?php
                if (Session::get('fee') != null) {
                    $total_after_shipping = Cart::total(0, ',', '') + Session::get('fee');
                }
                ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total</span>
                    <strong>{{number_format($total_after_shipping, 0 , ',' , '.')}} đ</strong>
                </li>
                @else
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-danger">
                        <h6 class="my-0">Shipping fee</h6>
                    </div>
                    <span class="text-danger">0 đ</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total</span>
                    <strong>{{Cart::total(0 , ',' , '.').' '.'đ'}}</strong>
                </li>
                @endif
            </ul>

        </div>
        <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Billing address</h4>
            <form method="POST" action="">
                @csrf
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="shipping_name" class="form-label">Full name</label>
                        <input type="text" class="form-control shipping_name" name="shipping_name" id="shipping_name" value="{{Session::get('account_name')}}">
                    </div>

                    <div class="col-12">
                        <label for="shipping_email" class="form-label">Email
                            <!-- <span class="text-muted">(Optional)</span> -->
                        </label>
                        <input type="email" class="form-control shipping_email" name="shipping_email" id="shipping_email" value="{{Session::get('account_email')}}">
                    </div>

                    <div class="col-12">
                        <label for="shipping_address" class="form-label">Address</label>
                        <input type="text" class="form-control shipping_address" name="shipping_address" id="shipping_address" placeholder="Where ur house?...">
                    </div>

                    <div class="col-12">
                        <label for="shipping_phone" class="form-label">Phone</label>
                        <input type="text" class="form-control shipping_phone" name="shipping_phone" id="shipping_phone" value="{{Session::get('account_phone')}}">
                    </div>

                    <div class="col-12">
                        <label for="shipping_notes" class="form-label">Delivery note</label>
                        <span class="text-muted">(Optional)</span>
                        <textarea rows="5" type="text" class="form-control shipping_notes" name="shipping_notes" id="shipping_notes" placeholder="Wanna note something for deliver man?..."></textarea>
                    </div>
                </div>
                @if(Session::get('fee'))
                <input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
                @else
                <input type="hidden" name="order_fee" class="order_fee" value="50000">
                @endif

                @if(Session::get('coupon'))
                @foreach(Session::get('coupon') as $key => $cou)
                <input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
                @endforeach
                @else
                <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                @endif

                <hr class="my-4">

                <h4 class="mb-3">Payment</h4>

                <div class="my-3">
                    <div class="form-check">
                        <input id="cod" name="payment_select" type="radio" class="form-check-input payment_select" value="1" checked>
                        <label class="form-check-label" for="cod">COD</label>
                    </div>
                    <div class="form-check">
                        <input id="paypal" name="payment_select" type="radio" class="form-check-input payment_select" value="0">
                        <label class="form-check-label" for="paypal">Paypal</label>
                    </div>
                </div>

                <hr class="my-4">

                <input name="send_order" class="w-100 btn btn-danger btn-lg send_order" type="button" value="Continue to checkout">
            </form>
            <hr class="my-4">
        </div>
    </div>
</main>

@endsection