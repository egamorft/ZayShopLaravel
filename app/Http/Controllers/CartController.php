<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cart;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function save_cart(Request $request)
    {
        $product_id = $request->productid_hidden;
        $quantity = $request->qty;
        $product_info = DB::table('tbl_product')->where('product_id', $product_id)->first();

        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = '68';
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        return Redirect::to('/shop-cart');
    }

    public function shop_cart()
    {
        return view('pages.cart.shop_cart');
    }

    public function delete_cart($rowId)
    {
        Cart::update($rowId,0);
        return Redirect::to('/shop-cart');
    }
}
