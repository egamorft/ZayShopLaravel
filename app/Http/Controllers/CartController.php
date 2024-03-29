<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function save_cart(Request $request)
    {
        $product_id = $request->productid_hidden;
        $quantity = $request->qty;
        $product_info = Product::where('product_id', $product_id)->first();

        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['options']['in_stock'] = $product_info->product_quantity;
        $data['weight'] = '68';
        $data['options']['image'] = $product_info->product_image;

        if ($data['options']['in_stock'] < $data['qty']) {
            Session::put('error', 'Quantity in stock is not enough');
            return back();
        } else {
            Cart::add($data);
            Cart::setGlobalTax(10);
            return Redirect::to('/shop-cart');
        }
    }

    public function shop_cart()
    {
        return view('pages.cart.shop_cart');
    }

    public function delete_cart($rowId)
    {
        Cart::update($rowId, 0);

        return Redirect::to('/shop-cart');
    }

    public function update_cart(Request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId, $qty);

        return Redirect::to('/shop-cart');
    }

    public function save_cart_home(Request $request)
    {
        $product_id = $request->productid_hidden;
        $quantity = '1';
        $product_info = Product::where('product_id', $product_id)->first();

        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['options']['in_stock'] = $product_info->product_quantity;
        $data['price'] = $product_info->product_price;
        $data['weight'] = '68';
        $data['options']['image'] = $product_info->product_image;
        
        if ($data['options']['in_stock'] < $data['qty']) {
            Session::put('error', 'Error');
            return back();
        } else {
            Cart::add($data);
            Cart::setGlobalTax(10);
            Session::put('message', 'Add ' . $data['name'] . ' to cart');
            return back();
        }
    }
}
