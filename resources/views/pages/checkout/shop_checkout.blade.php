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

<?php
$content = Cart::content();

$tax = Cart::pricetotal(0, ',', '') * 10 / 100;

$total_all = Cart::total(0, ',', '') + Session::get('fee');
?>
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="text-left logo p-2 px-5">

                                <a class="navbar-brand text-success logo h1 align-self-center" href="{{URL::to('/')}}">
                                    Zay Shop
                                </a>


                            </div>
                            <h3 class="text-left logo p-2 px-5" id="countdown"></h3>
                            <div class="invoice p-5">

                                <h5>Your order is now Confirmed!</h5>

                                <span class="font-weight-bold d-block mt-4">Hello, <?php echo Session::get('account_name'); ?></span>
                                <span>You order has been confirmed and will coming to you as soon as possible!</span>

                                <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">

                                    <table class="table table-borderless">

                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="py-2">

                                                        <span class="d-block text-muted">Order Date</span>
                                                        <span>12 Jan,2018</span>

                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="py-2">

                                                        <span class="d-block text-muted">Order No</span>
                                                        <span>MT12332345</span>

                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="py-2">

                                                        <span class="d-block text-muted">Payment</span>
                                                        <span><img src="https://img.icons8.com/color/48/000000/mastercard.png" width="20" /></span>

                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="py-2">

                                                        <span class="d-block text-muted">Shiping Address</span>
                                                        <span>414 Advert Avenue, NY,USA</span>

                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>





                                </div>




                                <div class="product border-bottom table-responsive">

                                    <table class="table table-borderless">

                                        <tbody>
                                            @foreach($content as $con)
                                            <tr>
                                                <td width="20%">

                                                    <img src="{{URL::to('/public/upload/product/'.$con->options->image)}}" width="90px">

                                                </td>

                                                <td width="60%">
                                                    <span class="font-weight-bold">{{$con->name}}</span>
                                                    <div class="product-qty">
                                                        <small class="text-muted">Quantity:{{$con->qty}}</small>

                                                    </div>
                                                </td>
                                                <td width="20%">
                                                    <div class="text-right">
                                                        <span class="font-weight-bold">{{$con->price(0 , ',' , '.').' '.'đ'}}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>



                                </div>



                                <div class="row d-flex justify-content-end">

                                    <div class="col-md-5">

                                        <table class="table table-borderless">

                                            <tbody class="totals">

                                                <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">Subtotal</span>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span>{{Cart::pricetotal(0 , ',' , '.').' '.'đ'}}</span>
                                                        </div>
                                                    </td>
                                                </tr>

                                                @if(Session::get('fee'))
                                                <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">Shipping Fee</span>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span class="text-danger">{{number_format(Session::get('fee'), 0 , ',' , '.')}} đ</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @else
                                                <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">Shipping Fee</span>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span class="text-danger">0 đ</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif


                                                <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">Tax Fee</span>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span class="text-danger">{{number_format($tax, 0, ',', '.').' '.'đ'}}</span>
                                                        </div>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">Discount</span>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span class="text-success">{{Cart::discount(0 , ',' , '.').' '.'đ'}}</span>
                                                        </div>
                                                    </td>
                                                </tr>


                                                <tr class="border-top border-bottom">
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="font-weight-bold">Subtotal</span>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span class="font-weight-bold">{{number_format($total_all, 0 , ',' , '.')}} đ</span>
                                                        </div>
                                                    </td>
                                                </tr>

                                            </tbody>

                                        </table>

                                    </div>



                                </div>


                                <p>We will be sending shipping confirmation email when the item shipped successfully!</p>
                                <p class="font-weight-bold mb-0">Thanks for shopping with us!</p>
                                <span>Zay Shop Team</span>





                            </div>


                            <div class="d-flex justify-content-between footer p-3">

                                <span>Need Help? visit our <a href="#"> help center</a></span>
                                @php
                                $orderDate = Carbon\Carbon::now();
                                echo $orderDate->format('d/m/Y');
                                @endphp

                            </div>




                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
    Open modal
</button>


<!--Check out content -->
<main class="container">
    <div class="py-5 text-center">
        <h2>Checkout form</h2>
    </div>
    @if(Cart::count() == 0)
    <h2>Your cart is still null</h2>
    <a class="btn btn-success" href="{{URL::to('/shop')}}" role="button">Shopping now</a>
    <h4>OR</h4>
    <a class="btn btn-success" href="{{URL::to('/shop-cart')}}" role="button">Check your cart</a>
    @else
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
                    <span class="text-danger">{{number_format($tax, 0, ',', '.').' '.'đ'}}</span>
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
    @endif
</main>

@endsection