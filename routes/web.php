<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Public frontend
Route::get('/', 'HomeController@home');

Route::get('/about', 'HomeController@about');

Route::get('/contact', 'HomeController@contact');

Route::get('/shop', 'HomeController@shop');

Route::get('/login', 'HomeController@login');

Route::post('/login-account', 'HomeController@login_account');

Route::get('/register', 'HomeController@register');

Route::post('/register-account', 'HomeController@register_account');

Route::get('/logout_account', 'HomeController@logout_account');

Route::get('/search', 'HomeController@search');

//Login facebook
Route::get('/login-facebook','HomeController@login_facebook');
Route::get('/callback','HomeController@callback_facebook');

//Login  google
Route::get('/login-google','HomeController@login_google');
Route::get('/google/callback','HomeController@callback_google');

//Backend - Admin
Route::get('/admin', 'AdminController@home');

Route::get('/dashboard', 'AdminController@dashboard');

Route::post('/admin-login', 'AdminController@login');

Route::get('/logout', 'AdminController@logout');

//Category
Route::get('/show-category', 'CategoryController@show_category');

Route::get('/add-category', 'CategoryController@add_category');

Route::post('/save-category', 'CategoryController@save_category');

Route::get('/unactive-category/{category_id}', 'CategoryController@unactive_category');

Route::get('/active-category/{category_id}', 'CategoryController@active_category');

Route::get('/edit-category/{category_id}', 'CategoryController@edit_category');

Route::get('/delete-category/{category_id}', 'CategoryController@delete_category');

Route::post('/update-category/{category_id}', 'CategoryController@update_category');

//SubCategory
Route::get('/show-sub-category', 'SubCategoryController@show_sub_category');

Route::get('/add-sub-category', 'SubCategoryController@add_sub_category');

Route::post('/save-sub-category', 'SubCategoryController@save_sub_category');

Route::get('/unactive-sub-category/{subcategory_id}', 'SubCategoryController@unactive_sub_category');

Route::get('/active-sub-category/{subcategory_id}', 'SubCategoryController@active_sub_category');

Route::get('/edit-sub-category/{subcategory_id}', 'SubCategoryController@edit_sub_category');

Route::get('/delete-sub-category/{subcategory_id}', 'SubCategoryController@delete_sub_category');

Route::post('/update-sub-category/{subcategory_id}', 'SubCategoryController@update_sub_category');

//Product
Route::get('/show-product', 'ProductController@show_product');

Route::get('/add-product', 'ProductController@add_product');

Route::post('/select-category', 'ProductController@select_category');

Route::post('/save-product', 'ProductController@save_product');

Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product');

Route::get('/active-product/{product_id}', 'ProductController@active_product');

Route::get('/edit-product/{product_id}', 'ProductController@edit_product');

Route::post('/update-product/{product_id}', 'ProductController@update_product');

Route::get('/delete-product/{product_id}', 'ProductController@delete_product');

//Category - Home
Route::get('/category/{category_id}', 'CategoryController@shop_category');

Route::get('/subcategory/{subcategory_id}', 'SubcategoryController@shop_subcategory');

Route::get('/product-details/{product_id}', 'ProductController@product_details');

//Cart
Route::post('/save-cart', 'CartController@save_cart');

Route::get('/shop-cart', 'CartController@shop_cart');

Route::get('/delete-cart/{rowId}', 'CartController@delete_cart');

Route::post('/update-cart', 'CartController@update_cart');

Route::post('/save-cart-home', 'CartController@save_cart_home');

//Checkout
Route::get('/check-out', 'CheckoutController@check_out');

Route::post('/confirm-order', 'CheckoutController@confirm_order');

//Coupon
Route::post('/check-coupon', 'CouponController@check_coupon');

Route::get('/show-coupon', 'CouponController@show_coupon');

Route::get('/add-coupon', 'CouponController@add_coupon');

Route::post('/save-coupon', 'CouponController@save_coupon');

Route::get('/delete-coupon/{coupon_id}', 'CouponController@delete_coupon');

Route::get('/unset-coupon', 'CouponController@unset_coupon');

//Delivery
Route::get('/delivery', 'DeliveryController@delivery');

Route::post('/select-delivery', 'DeliveryController@select_delivery');

Route::post('/insert-delivery', 'DeliveryController@insert_delivery');

Route::post('/select-feeship', 'DeliveryController@select_feeship');

Route::post('/update-delivery', 'DeliveryController@update_delivery');

Route::post('/select-delivery-home', 'DeliveryController@select_delivery_home');

Route::post('/calculate-fee', 'DeliveryController@calculate_fee');

Route::get('/del-fee', 'DeliveryController@del_fee');

//Order
Route::get('/order', 'OrderController@show_order');

Route::get('/view-order/{order_code}', 'OrderController@view_order');

Route::get('/print-bill/{checkout_code}', 'OrderController@print_bill');

Route::get('/delete-order/{order_code}', 'OrderController@delete_order');