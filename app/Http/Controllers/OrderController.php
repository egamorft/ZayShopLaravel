<?php

namespace App\Http\Controllers;

use App\Account;
use App\Coupon;
use App\Order;
use App\OrderDetails;
use App\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function show_order()
    {
        $order = Order::orderBy('created_at', 'DESC')->get();
        return view('admin.order.show_order')->with(compact('order'));
    }

    public function view_order($order_code)
    {
        // $order_details = OrderDetails::where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code)->get();
        foreach ($order as $key => $od) {
            $account_id = $od->account_id;
            $shipping_id = $od->shipping_id;
        }
        $account = Account::where('account_id', $account_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();
        $details = OrderDetails::with('product')->where('order_code', $order_code)->first();
        $order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();
        foreach ($order_details as $key => $order_d) {
            $product_coupon = $order_d->product_coupon;
        }
        if ($product_coupon != 'no') {
            $coupon = Coupon::where('coupon_code', $product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        } else {
            $coupon_condition = 2;
            $coupon_number = 0;
        }

        return view('admin.order.view_order')->with(compact('details', 'order_details', 'account', 'shipping', 'coupon_condition', 'coupon_number'));
    }

    public function delete_order($order_code)
    {
        $shipping_id = Order::where('order_code', $order_code)->first();
        Order::where('order_code', $order_code)->delete();
        OrderDetails::where('order_code', $order_code)->delete();
        Shipping::where('shipping_id', $shipping_id->shipping_id)->delete();
        Session::put('message', 'Successfully delete order ' . $order_code);
        return Redirect::to('/order');
    }

    public function print_bill($checkout_code)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_bill_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_bill_convert($checkout_code)
    {
        $order_details = OrderDetails::where('order_code', $checkout_code)->get();
        $order = Order::where('order_code', $checkout_code)->get();
        $order_date = Order::where('order_code', $checkout_code)->first();
        foreach ($order as $key => $od) {
            $account_id = $od->account_id;
            $shipping_id = $od->shipping_id;
        }
        $account = Account::where('account_id', $account_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();
        $order_details_product = OrderDetails::with('product')->where('order_code', $checkout_code)->get();
        $output = '';
        $output .= '
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
        body{
            font-family: DejaVu Sans;
        }
        </style>
        <div class="card">
        <div class="card-body">
          <div class="container mb-5 mt-3">
            <div class="row d-flex align-items-baseline">
              <div class="col-xl-9">
                <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID: #' . strtoupper($checkout_code) . '</strong></p>
              </div>
              <hr>
            </div>
      
            <div class="container">
              <div class="col-md-12">
                <center>
                    <h1>
                      ZAY SHOP
                    </h1>
                </center>
      
              </div>
      
      
              <div class="row">
                <div class="col-xl-8">
                  <ul class="list-unstyled">
                    <li class="text-muted">To: <span style="color:#5d9fc5 ;">' . $account->account_name . '</span></li>
                    <li class="text-muted">Address: ' . $shipping->shipping_address . '</li>
                    <li class="text-muted">Email: ' . $account->account_email . '</li>
                    <li class="text-muted">Phone number: ' . $account->account_phone . '</li>
                  </ul>
                </div>
                <hr>
                <div class="col-xl-4">
                  <p class="text-muted">Invoice</p>
                  <ul class="list-unstyled">
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="fw-bold">ID:</span>#' . strtoupper($checkout_code) . '</li>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="fw-bold">Creation Date: </span>' . $order_date->created_at . '</li>
                  </ul>
                </div>
                <hr>
              </div>
      
              <div class="row my-2 mx-1 justify-content-center">
                <table class="table table-striped table-borderless">
                  <thead style="background-color:#84B0CA ;" class="text-white">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Product Name</th>
                      <th scope="col">Coupon</th>
                      <th scope="col">Qty</th>
                      <th scope="col">Unit Price</th>
                      <th scope="col">Total Amount</th>
                    </tr>
                  </thead>
                  <tbody>';
                  $total = 0;
                  $i = 0;
                  foreach($order_details_product as $key => $product){
                    $i++;
                    $subtotal = $product->product_price * $product->product_sales_quantity;
                    $total += $subtotal;
                    if($product->product_coupon != 'no'){
                        $product_coupon = $product->product_coupon;
                    }else{
                        $product_coupon = 'NULL';
                    }
                  $output .='
                    <tr>
                      <th scope="row">'. $i.'</th>
                      <td>'. $product->product_name.'</td>
                      <td>'. $product_coupon.'</td>
                      <td>'.$product->product_sales_quantity.'</td>
                      <td>'. number_format($product->product_price, 0 , ',', '.').'đ</td>
                      <td>'. number_format($subtotal, 0 , ',', '.').'đ</td>
                    </tr>
                    ';
                    
                  }
                  $tax = ($total * 10) /100;
                  $output .='
                  </tbody>
      
                </table>
              </div>
              <div class="row">
                <div class="col-xl-3">
                  <ul class="list-unstyled">
                    <li class="text-muted ms-3"><span class="text-black me-4">Fee Ship</span>'. number_format($product->product_feeship, 0 , ',', '.').'đ</li>
                    <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(15%)</span>'. number_format($tax, 0 , ',', '.').'đ</li>
                  </ul>
                  <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span
                      style="font-size: 25px;">'. number_format($total, 0 , ',', '.').'đ</span></p>
                </div>
              </div>
              <hr>
      
            </div>
          </div>
        </div>
      </div>';

        return $output;
    }
}
