@extends('admin_layout')
@section('admin_content')

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

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Customer information</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Customer name</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Customer phone</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Customer email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="font-weight-bold d-flex px-2 py-1">
                                            {{$account->account_name}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$account->account_phone}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$account->account_email}}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Shipping information</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Shipping to</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Shipping address</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Phone number</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Email</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Shipping notes</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Shipping method</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="font-weight-bold d-flex px-2 py-1">
                                            {{$shipping->shipping_name}}

                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$shipping->shipping_address}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$shipping->shipping_phone}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$shipping->shipping_email}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$shipping->shipping_notes}}
                                        </p>
                                    </td>
                                    <td>
                                        @if($shipping->shipping_method == 0)
                                        <p class="font-weight-bold mb-0">
                                            Paypal
                                        </p>
                                        @elseif($shipping->shipping_method == 1)
                                        <p class="font-weight-bold mb-0">
                                            COD
                                        </p>
                                        @else
                                        <p class="font-weight-bold mb-0">
                                            Unidentified
                                        </p>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Order details</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7"></th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Product name</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Coupon</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Quantity</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Product price</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Subtotal</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 0;
                                $total = 0;
                                @endphp
                                @foreach($order_details as $key => $details)
                                @php
                                $i++;
                                $subtotal = $details->product_price * $details->product_sales_quantity;
                                $total += $subtotal;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="justify-content-center">
                                                {{$i}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$details->product_name}}
                                        </p>
                                    </td>
                                    <td>

                                        @if($details->product_coupon != 'no')

                                        <p class="font-weight-bold mb-0">
                                            {{$details->product_coupon}}
                                        </p>
                                        @else

                                        <p class="font-weight-italic mb-0">
                                            NULL
                                        </p>

                                        @endif
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$details->product_sales_quantity}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{number_format($details->product_price, 0 , ',' , '.')}}đ
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{number_format($subtotal, 0 , ',' , '.')}}đ
                                        </p>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    @php
                                    $total_coupon = 0;
                                    @endphp
                                    @if($coupon_condition)
                                    @if($coupon_condition == 1)
                                    @php
                                    $total_coupon = $total - (($coupon_number/100) * $total)
                                    @endphp
                                    @else
                                    @php
                                    $total_coupon = $total - $coupon_number
                                    @endphp
                                    @endif
                                    @endif
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <p class="text-success font-weight-bold mb-0">
                                            SubTotal: {{number_format($total, 0 , ',' , '.')}}đ
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-success font-weight-bold mb-0">
                                            Coupon discount:{{number_format(($coupon_number/100) * $total, 0 , ',' , '.')}}đ
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-success font-weight-bold mb-0">
                                            Total bill: {{number_format($total_coupon, 0 , ',' , '.')}}đ
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection