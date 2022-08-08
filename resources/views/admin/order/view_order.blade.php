@extends('components.admin_layout.admin_layout')
@section('admin_content')
@extends('components.alert.alert')

<div class="container-fluid">
    <div class="col-11 text-start">
        @foreach($order as $key => $or)
        @if($or->order_status == 2)
        <a target="_blank" href="{{URL::to('/print-bill/'.$details->order_code)}}" class="btn bg-gradient-dark mb-0">
            <i class="material-icons text-sm">
                print
            </i>&nbsp;&nbsp;
            Print bill
        </a>
        @endif
        @endforeach
    </div>
</div>
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">
                            Customer information
                        </h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                        Customer name
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Customer phone
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Customer email
                                    </th>
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
                        <h6 class="text-white text-capitalize ps-3">
                            Shipping information
                        </h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                        Shipping to
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Shipping address
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Phone number
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Email
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Shipping notes
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Shipping method
                                    </th>

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
                                        @if($shipping->shipping_method == 1)
                                        <p class="font-weight-bold mb-0">
                                            COD
                                        </p>
                                        @elseif($shipping->shipping_method == 2)
                                        <p class="font-weight-bold mb-0">
                                            MOMO
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
                        <h6 class="text-white text-capitalize ps-3">
                            Order details
                        </h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">

                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Product name</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Product in stock
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Coupon
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Fee ship
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Quantity
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Product price
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Subtotal
                                    </th>

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
                                <tr class="color_qty_{{$details->product_id}}">
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
                                        <p class="font-weight-bold mb-0">
                                            {{$details->product->product_quantity}}
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
                                            {{number_format($details->product_feeship, 0 , ',' , '.')}}đ
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            <input {{ $order_status == 2 || $order_status == 4 ?"disabled":'' }} type="number" class="order_qty_{{$details->product_id}}" min="1" value="{{$details->product_sales_quantity}}" name="product_sales_quantity">

                                            <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->product_quantity}}">

                                            <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">

                                            <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">
                                            @if($order_status == 2 || $order_status == 4 )
                                            <button disabled data-product_id="{{$details->product_id}}" name="update_quantity_order" class="btn btn-dark update_quantity_order">
                                                Update
                                            </button>
                                            @else
                                            <button data-product_id="{{$details->product_id}}" name="update_quantity_order" class="btn btn-success update_quantity_order">
                                                Update
                                            </button>
                                            @endif
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
                                    $tax = $total * 10 / 100;
                                    @endphp
                                    @if($coupon_condition)
                                    @if($coupon_condition == 1)
                                    @php
                                    $total_coupon = $total - (($coupon_number/100) * $total) + $details->product_feeship + $tax
                                    @endphp
                                    @else
                                    @php
                                    $total_coupon = $total - $coupon_number + $details->product_feeship + $tax
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
                                        <p class="text-danger font-weight-bold mb-0">
                                            Tax: {{number_format($tax, 0 , ',' , '.')}}đ
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-danger font-weight-bold mb-0">
                                            Fee ship:{{number_format($details->product_feeship, 0 , ',' , '.')}}đ
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
                                <tr>
                                    <td colspan="2">
                                        @foreach($order as $key => $or)
                                        @if($or->order_status==1)
                                        <form class="input-group input-group-outline mb-3">
                                            @csrf
                                            <select class="form-control order_details">
                                                <option id="{{$or->order_id}}" value="1" selected>
                                                    --------Choose order status--------
                                                </option>
                                                <option id="{{$or->order_id}}" value="2">
                                                    Delivering
                                                </option>
                                                <option id="{{$or->order_id}}" value="3">
                                                    Cancel/ Pending order
                                                </option>
                                            </select>
                                        </form>
                                        @elseif($or->order_status==2)
                                        <form class="input-group input-group-outline mb-3">
                                            @csrf
                                            <select class="form-control order_details">
                                                <option id="{{$or->order_id}}" value="2" selected>
                                                    Delivering
                                                </option>
                                                <option id="{{$or->order_id}}" value="3">
                                                    Cancel/ Pending order
                                                </option>
                                            </select>
                                        </form>
                                        @elseif($or->order_status==3)

                                        <form class="input-group input-group-outline mb-3">
                                            @csrf
                                            <select class="form-control order_details">
                                                <option id="{{$or->order_id}}" value="2">
                                                    Delivering
                                                </option>
                                                <option id="{{$or->order_id}}" value="3" selected>
                                                    Cancel/ Pending order
                                                </option>
                                            </select>
                                        </form>
                                        @elseif($or->order_status==4)

                                        <select disabled class="form-control order_details">
                                            <option>
                                                Completed
                                            </option>
                                        </select>

                                        @endif
                                        @endforeach
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