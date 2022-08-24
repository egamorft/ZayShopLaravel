@extends('components.public_layout.layout')
@section('content')
@extends('components.alert.alert')

<?php

$content = Cart::content();

$tax = Cart::pricetotal(0, ',', '') * 10 / 100;

$total_all = Cart::total(0, ',', '') + Session::get('fee');

$orderDate = Carbon\Carbon::now();

$total_usd = 0;

?>

<main class="container">
    <div class="py-5 text-center">
        <h2>
            {{ __('checkout/checkout.Checkout form') }}
        </h2>
    </div>
    @if(Cart::count() == 0)
        <h2>
            {{ __('checkout/checkout.Your cart is still null') }}
        </h2>
        <hr style="width: 30%;">
        <a class="btn btn-success" href="{{URL::to('/shop')}}" role="button">
            {{ __('checkout/checkout.Shopping now') }}
        </a>
        <hr style="width: 30%;">
        <h4>
            {{ __('checkout/checkout.OR') }}
        </h4>
        <hr style="width: 30%;">
        <a class="btn btn-success" href="{{URL::to('/shop-cart')}}" role="button">
            {{ __('checkout/checkout.Check your cart') }}
        </a>
        <hr style="width: 30%;">
    @else
    <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">

            <form>
                @if(Session::get('fee') || Session::get('ward'))
                <fieldset disabled id="fieldset">
                    @endif
                    @csrf
                    <div class="col-md">
                        <label for="city" class="form-label">
                            {{ __('checkout/checkout.City') }}
                        </label>
                        <strong style="color: red;">*</strong>
                        <select name="city" id="city" class="form-control choose city">
                            @if(Session::get('city'))
                            <option>{{Session::get('city')}}</option>
                            @endif
                            <option value="">
                                -----{{ __('checkout/checkout.Choose your city') }}-----
                            </option>
                            @foreach($city as $key => $ci)
                                <option value="{{$ci->matp}}">
                                    {{$ci->name_city}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md">
                        <label for="state" class="form-label">
                            {{ __('checkout/checkout.Province') }}
                        </label>
                        <strong style="color: red;">*</strong>
                        <select name="province" id="province" class="form-control province choose">
                            @if(Session::get('province'))
                            <option>{{Session::get('province')}}</option>
                            @endif
                            <option value="">
                                -----{{ __('checkout/checkout.Choose your province') }}-----
                            </option>
                        </select>
                    </div>

                    <div class="col-md">
                        <label for="state" class="form-label">
                            {{ __('checkout/checkout.Wards') }}
                        </label>
                        <strong style="color: red;">*</strong>
                        <select name="wards" id="wards" class="form-control wards">
                            @if(Session::get('ward'))
                            <option>{{Session::get('ward')}}</option>
                            @endif
                            <option value="">
                                -----{{ __('checkout/checkout.Choose your wards') }}-----
                            </option>
                        </select>
                    </div>
                    <hr class="my-4">
                    @if(Session::get('fee'))
                        <div class="col-md">
                            <input type="button" value="{{ __('checkout/checkout.Calculate delivery') }}" 
                                name="calculate_order" class="w-100 btn btn-dark btn-lg calculate_delivery">
                        </div>
                    @else
                        <div class="col-md">
                            <input type="button" value="{{ __('checkout/checkout.Calculate delivery') }}" 
                                name="calculate_order" class="w-100 btn btn-primary btn-lg calculate_delivery">
                        </div>
                    @endif
                    <hr class="my-4">
                    @if(Session::get('fee'))
                </fieldset>
                @endif
            </form>
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">
                    {{ __('checkout/checkout.Check your cart') }}
                </span>
                <span class="badge bg-primary rounded-pill">
                    {{Cart::count()}}
                </span>
            </h4>
            <ul class="list-group mb-3">
                @foreach($content as $value)
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">
                            {{$value->name}}
                        </h6>
                        <small class="text-muted">
                            {{$value->qty}}
                        </small>
                    </div>
                    <span class="text-muted">
                        {{number_format($value->price, 0, ',', '.').' '.'đ'}}
                    </span>
                </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between">
                    <span>
                        {{ __('checkout/checkout.Sub Total') }}
                    </span>
                    <strong>
                        {{Cart::pricetotal(0 , ',' , '.').' '.'đ'}}
                    </strong>
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-danger">
                        <h6 class="my-0">
                            {{ __('checkout/checkout.Tax') }}
                        </h6>
                        <small>
                            10% {{ __('checkout/checkout.cart') }}
                        </small>
                    </div>
                    <span class="text-danger">
                        {{number_format($tax, 0, ',', '.').' '.'đ'}}
                    </span>
                </li>
                @if(Session::get('coupon'))
                    @foreach(Session::get('coupon') as $key => $cou)
                        @if($cou['coupon_condition']==1)
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div class="text-success">
                                    <h6 class="my-0">
                                        {{ __('checkout/checkout.Promo code') }}
                                    </h6>
                                    <small>
                                        <?php 
                                            echo '-' . $cou['coupon_number'] . '% cart' 
                                        ?>
                                    </small>
                                </div>
                                <span class="text-success">
                                    <?php
                                        $money_discount = Cart::pricetotal(0, ',', '') * $cou['coupon_number']/100;
                                    ?>
                                    {{number_format($money_discount, 0 , ',' , '.')}} đ
                                </span>
                            </li>
                        @endif
                    @endforeach
                    @else
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">
                                {{ __('checkout/checkout.Promo code') }}
                            </h6>
                            <small>
                                {{ __('checkout/checkout.NONE') }}
                            </small>
                        </div>
                        <span class="text-success">
                            <?php
                                $money_discount = 0;
                            ?>
                            {{number_format($money_discount, 0 , ',' , '.')}} đ
                        </span>
                    </li>
                @endif
                @if(Session::get('fee') || Session::get('ward'))
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-danger">
                        <h6 class="my-0">
                            {{ __('checkout/checkout.Shipping fee') }}
                        </h6>
                    </div>

                    <span class="text-danger">
                        {{number_format(Session::get('fee'), 0 , ',' , '.')}} đ
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <p>
                        {{ __('checkout/checkout.Delete address here') }}
                    </p>
                    <a class="cart_quantity_delete" href="{{url('/del-fee')}}">
                        <i style="color: red; font-size:120% ;" class="fa fa-xmark"></i>
                    </a>
                </li>
                <?php
                if (Session::get('fee') != null) {
                    $total_all = Cart::pricetotal(0, ',', '') - $money_discount + $tax + Session::get('fee');
                }
                ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span>
                        {{ __('checkout/checkout.Total') }}
                    </span>
                    <strong>
                        {{number_format($total_all, 0 , ',' , '.')}} đ
                    </strong>
                </li>
                @else
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-danger">
                        <h6 class="my-0">
                            {{ __('checkout/checkout.Shipping fee') }}
                        </h6>
                    </div>
                    <span class="text-danger">
                        0 đ
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>
                        {{ __('checkout/checkout.Total') }}
                    </span>
                    <strong>
                        <?php
                            $total_all = Cart::pricetotal(0, ',', '') - $money_discount + $tax;
                        ?>
                        {{number_format($total_all, 0 , ',' , '.')}} đ
                    </strong>
                </li>
                @endif
            </ul>

        </div>
        <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">
                {{ __('checkout/checkout.Billing address') }}
            </h4>
            <form method="POST" action="">
                @csrf
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="shipping_name" class="form-label">
                            {{ __('checkout/checkout.Full name') }}
                        </label>
                        <strong style="color: red;">*</strong>
                        <input type="text" class="form-control shipping_name" 
                            name="shipping_name" id="shipping_name" 
                                value="{{Session::get('account_name')}}">
                    </div>

                    <div class="col-12">
                        <label for="shipping_email" class="form-label">
                            {{ __('checkout/checkout.Email') }}
                        </label>
                        <strong style="color: red;">*</strong>
                        <input readonly type="email" class="form-control shipping_email" 
                            name="shipping_email" id="shipping_email" 
                                value="{{Session::get('account_email')}}">
                    </div>

                    <div class="col-12">
                        <label for="shipping_address" class="form-label">
                            {{ __('checkout/checkout.Address') }}
                        </label>
                        <strong style="color: red;">*</strong>
                        <input type="text" class="form-control shipping_address" 
                            name="shipping_address" id="shipping_address" 
                                placeholder="Where ur house?..." value="{{Session::get('account_address')}}">
                    </div>

                    <div class="col-12">
                        <label for="shipping_phone" class="form-label">
                            {{ __('checkout/checkout.Phone') }}
                        </label>
                        <strong style="color: red;">*</strong>
                        <input readonly type="text" class="form-control shipping_phone" 
                            name="shipping_phone" id="shipping_phone" 
                                value="{{Session::get('account_phone')}}">
                    </div>

                    <div class="col-12">
                        <label for="shipping_notes" class="form-label">
                            {{ __('checkout/checkout.Delivery note') }}
                        </label>
                        <span class="text-muted">
                            {{ __('checkout/checkout.(Optional)') }}
                        </span>
                        <textarea rows="5" type="text" class="form-control shipping_notes" 
                            name="shipping_notes" id="shipping_notes" 
                                placeholder="{{ __('checkout/checkout.Wanna note something for delivery man?...') }}"></textarea>
                    </div>
                </div>
                @if(Session::get('fee'))
                    <input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
                @else
                @endif

                @if(Session::get('coupon'))
                    @foreach(Session::get('coupon') as $key => $cou)
                        <input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
                    @endforeach
                @else
                    <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                @endif
                </br>
                <h6 style="color: red;">
                <strong>
                    * Note:
                </strong>
                <span>If you choose paypal as a payment gate, those red "*" above would be saved follow your paypal information</span>
                </h6>
                <hr class="my-4">

                <h4 class="mb-3">
                    {{ __('checkout/checkout.Payment') }}
                </h4>

                <div class="my-3">
                    <div class="form-check">
                        <input id="cod" name="payment_select" type="radio" class="form-check-input payment_select" value="1">
                        <label class="form-check-label" for="cod">
                            COD
                        </label>
                    </div>
                </div>
                @if(session()->has('signature'))
                <div class="my-3">
                    <div class="form-check">
                        <input id="momo" name="payment_select" type="radio" class="form-check-input payment_select" value="2" checked>
                        <label class="form-check-label" for="momo">
                            MOMO
                        </label>
                    </div>
                </div>
                @endif

                @if(!session()->has('signature'))
                <div class="my-3">
                    <div class="form-check">
                        <input type="hidden" class="total_momo" value="{{$total_all}}">
                        <input id="momo" name="payment_select" type="radio" class="form-check-input payment_select" value="2">
                        <label class="form-check-label" for="momo">
                            MOMO
                        </label>
                    </div>
                </div>
                @endif

                <hr class="my-4">
                @if(session()->has('signature'))
                <input id="automate_check_out" name="automate_check_out" class="w-100 btn btn-danger btn-lg automate_check_out" type="button" value="{{ __('checkout/checkout.Continue to checkout') }}">
                @endif
                @if(!session()->has('signature'))
                <input id="check_out" name="send_order_cod" class="w-100 btn btn-danger btn-lg check_out_method" type="button" value="{{ __('checkout/checkout.Continue to checkout') }}">
                @endif
                <hr class="my-4">

                @if(Session::get('fee'))
                    @php
                        $total_usd = ($total_all - Session::get('fee'))/23000;
                    @endphp
                @else
                    @php
                        $total_usd = $total_all/23000;
                    @endphp
                @endif

                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <img src="https://banhxegiatot.com/wp-content/uploads/2021/04/2887b4_3d2a6145f5534541be0340302a614812_mv2.gif" alt="">
                        </div>
                        <div class="col-6">
                            <center>
                                <h4 id="paypalfield">
                                    Free ship with Paypal
                                </h4>
                            </center>
                            <div id="smart-button-container">
                            <div style="text-align: center;">
                                <div id="paypal-button-container"></div>
                                <input type="hidden" id="total_usd" value="{{round($total_usd, 2)}}">
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <hr class="my-4">
        </div>
    </div>
    @endif
</main>


<div class="modal fade" id="OrderBill" data-bs-backdrop="static" 
    data-bs-keyboard="false" tabindex="-1" 
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button id="closeBill" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="text-left logo p-2 px-5">

                                <a class="navbar-brand text-success logo h1 align-self-center" 
                                    href="{{URL::to('/')}}">
                                    {{ __('checkout/checkout.Zay Shop') }}
                                </a>


                            </div>
                            <center>
                                <img src="https://media2.giphy.com/media/a0h7sAqON67nO/giphy.gif" alt="">
                            </center>
                            <h3 class="text-left logo p-2 px-5" id="countdown"></h3>
                            <div class="invoice p-5">

                                <h5>
                                    {{ __('checkout/checkout.Your order is now Confirmed!') }}
                                </h5>

                                <span class="font-weight-bold d-block mt-4">
                                    Hello, 
                                    <?php 
                                        echo Session::get('account_name'); 
                                    ?>
                                </span>
                                <span>
                                    {{ __('checkout/checkout.You order has been confirmed and will coming to you as soon as possible!') }}
                                </span>

                                <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">

                                    <table class="table table-borderless">

                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="py-2">

                                                        <span class="d-block text-muted">
                                                            {{ __('checkout/checkout.Order Date') }}
                                                        </span>
                                                        <span> 
                                                            <?php 
                                                                echo $orderDate->format('d/m/Y') 
                                                            ?>
                                                        </span>

                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="py-2">

                                                        <span class="d-block text-muted">
                                                            {{ __('checkout/checkout.Payment') }}
                                                        </span>
                                                        <span id="shipping_method"></span>

                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="py-2">

                                                        <span class="d-block text-muted">
                                                            {{ __('checkout/checkout.Shipping') }}
                                                        </span>
                                                        @if (Session::get('city'))
                                                        <span>
                                                            <?php 
                                                                echo Session::get('city'); 
                                                            ?>
                                                        </span>
                                                        @else
                                                        <span id="shipping_city"></span>
                                                        @endif
                                                    </br>
                                                        @if (Session::get('province'))
                                                        <span>
                                                            <?php 
                                                                echo Session::get('province');
                                                            ?>
                                                        </span>
                                                        @else
                                                        <span id="shipping_province"></span>
                                                        @endif
                                                    </br>
                                                        @if (Session::get('ward'))
                                                        <span>
                                                            <?php 
                                                                echo Session::get('ward'); 
                                                            ?>
                                                        </span>
                                                        @else
                                                        <span id="shipping_ward"></span>
                                                        @endif

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="py-2">

                                                        <span class="d-block text-muted">
                                                            {{ __('checkout/checkout.Address') }}
                                                        </span>
                                                        <span id="shipping_address"></span>

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

                                                    <img src="{{URL::to('/storage/app/public/products/'.$con->options->image)}}" 
                                                        width="90px">

                                                </td>

                                                <td width="60%">
                                                    <span class="font-weight-bold">
                                                        {{$con->name}}
                                                    </span>
                                                    <div class="product-qty">
                                                        <small class="text-muted">
                                                            {{ __('checkout/checkout.Quantity:') }}{{$con->qty}}
                                                        </small>

                                                    </div>
                                                </td>
                                                <td width="20%">
                                                    <div class="text-right">
                                                        <span class="font-weight-bold">
                                                            {{$con->price(0 , ',' , '.').' '.'đ'}}
                                                        </span>
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

                                                            <span class="text-muted">
                                                                {{ __('checkout/checkout.Subtotal') }}
                                                            </span>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span>
                                                                {{Cart::pricetotal(0 , ',' , '.').' '.'đ'}}
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>

                                                @if(Session::get('fee'))
                                                <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">
                                                                {{ __('checkout/checkout.Shipping Fee') }}
                                                            </span>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span class="text-danger">
                                                                {{number_format(Session::get('fee'), 0 , ',' , '.')}} đ
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @else
                                                <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">
                                                                {{ __('checkout/checkout.Shipping Fee') }}
                                                            </span>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span class="text-danger">
                                                                0 đ
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif


                                                <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">
                                                                {{ __('checkout/checkout.Tax Fee') }}
                                                            </span>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span class="text-danger">
                                                                {{number_format($tax, 0, ',', '.').' '.'đ'}}
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">
                                                                {{ __('checkout/checkout.Discount') }}
                                                            </span>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span class="text-success">
                                                                {{Cart::discount(0 , ',' , '.').' '.'đ'}}
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>


                                                <tr class="border-top border-bottom">
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="font-weight-bold">
                                                                {{ __('checkout/checkout.Total') }}
                                                            </span>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span class="font-weight-bold">
                                                                {{number_format($total_all, 0 , ',' , '.')}} đ
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>

                                        </table>

                                        <img id="paid" style="display: none;" src="https://media.giphy.com/media/UfCQR5Nfp2dLIbMrBS/giphy.gif" alt="paid">
                                    </div>
                                </div>
                                
                                


                                <p>
                                    {{ __('checkout/checkout.We will be sending shipping confirmation email when the item shipped successfully!') }}
                                </p>
                                <p class="font-weight-bold mb-0">
                                    {{ __('checkout/checkout.Thanks for shopping with us!') }}
                                </p>
                                <span>
                                    {{ __('checkout/checkout.Zay Shop Team') }}
                                </span>





                            </div>


                            <div class="d-flex justify-content-between footer p-3">

                                <span>
                                     {{ __('checkout/checkout.Need Help? visit our') }}
                                    <a href="#"> 
                                        {{ __('checkout/checkout.help center') }}
                                    </a>
                                </span>
                                @php
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

@endsection