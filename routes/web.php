<?php

use Illuminate\Support\Facades\Mail;
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

Route::get('/shop', 'HomeController@shop')->name('shop');

Route::get('/login', 'HomeController@login');

Route::post('/login-account', 'HomeController@login_account');

Route::get('/register', 'HomeController@register');

Route::post('/register-account', 'HomeController@register_account');

Route::get('/logout_account', 'HomeController@logout_account');

Route::get('/search', 'HomeController@search');

//Login facebook
Route::get('/login-facebook', 'HomeController@login_facebook');
Route::get('/callback', 'HomeController@callback_facebook');

//Login  google
Route::get('/login-google', 'HomeController@login_google');
Route::get('/google/callback', 'HomeController@callback_google');

//Backend - Admin
Route::get('/admin', 'AdminController@home')->name('admin');

Route::post('/admin-login', 'AdminController@login');

Route::get('/logout', 'AdminController@logout');

Route::middleware('admin.login')->group(function () {

    //Admin dashboard
        Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');

        Route::post('/filter-by-date', 'AdminController@filter_by_date');

        Route::post('/dashboard-filter', 'AdminController@dashboard_filter');

        Route::post('/days-order', 'AdminController@days_order');
    //End Admin

    //Category Admin
    Route::get('/show-category', function () {
        return view('admin.category.show_category');
    })->name('category');
    // End Category Admin

    //SubCategory Admin
    Route::get('/show-sub-category', function () {
        return view('admin.subcategory.show_sub_category');
    })->name('subcategory');
    //End SubCategory Admin

    //Product Admin
    Route::get('/show-product', 'ProductController@show_product')->name('product');

    Route::get('/add-product', 'ProductController@add_product');

    Route::post('/select-category', 'ProductController@select_category');

    Route::post('/save-product', 'ProductController@save_product');

    Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product');

    Route::get('/active-product/{product_id}', 'ProductController@active_product');

    Route::get('/edit-product/{product_id}', 'ProductController@edit_product');

    Route::post('/update-product/{product_id}', 'ProductController@update_product');

    Route::get('/delete-product/{product_id}', 'ProductController@delete_product');
    //End Product Admin

    //Coupon Admin
    
    Route::get('/show-coupon', function () {
        return view('admin.coupon.show_coupon');
    })->name('coupon');
    
    //End Coupon Admin

    //Delivery Admin
    Route::get('/delivery', 'DeliveryController@delivery')->name('delivery');
    //End Delivery Admin

    //Order Admin
    Route::get('/order', 'OrderController@show_order')->name('order');

    Route::get('/view-order/{order_code}', 'OrderController@view_order');

    Route::get('/print-bill/{checkout_code}', 'OrderController@print_bill');

    Route::get('/delete-order/{order_code}', 'OrderController@delete_order');
    //End Order Admin



    //Slider Admin
    Route::get('/slider', function () {
        return view('admin.slider.show_slider');
    })->name('slider');
    //End Slider Admin
});


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

//Coupon Home

Route::post('/check-coupon', 'CouponController@check_coupon');

Route::get('/unset-coupon', 'CouponController@unset_coupon');

//Delivery

Route::post('/select-delivery', 'DeliveryController@select_delivery');

Route::post('/insert-delivery', 'DeliveryController@insert_delivery');

Route::post('/select-feeship', 'DeliveryController@select_feeship');

Route::post('/update-delivery', 'DeliveryController@update_delivery');

Route::post('/select-delivery-home', 'DeliveryController@select_delivery_home');

Route::post('/calculate-fee', 'DeliveryController@calculate_fee');

Route::get('/del-fee', 'DeliveryController@del_fee');

//Order

Route::post('/update-order-qty', 'OrderController@update_order_qty');

Route::post('/update-qty', 'OrderController@update_qty');

//User manager

Route::get('/profile/order', 'AccountController@order')->name('profile.order');

Route::post('/complete-order', 'AccountController@complete_order');

Route::get('/profile/account', 'AccountController@account')->name('profile.account');

Route::post('/save-profile', 'AccountController@save_profile');

Route::get('/profile/chgpwd', 'AccountController@change_password')->name('profile.chgpwd');

Route::post('/save-password', 'AccountController@save_password');

//Send mail
Route::post('/send-mail-confirm-order', 'SendMailController@confirm_order');

Route::post('/send-mail-delivery', 'SendMailController@confirm_delivery');

Route::get('/confirm-account', 'SendMailController@confirm_account')->name('confirm-account');

Route::get('/check-verify/{verify_code}', 'HomeController@check_verify');

Route::get('/reset-password', 'AccountController@reset_password');

Route::post('/confirm-reset-password', 'AccountController@confirm_reset_password');

Route::get('/verify-code-reset-password', 'SendMailController@verify_code_reset_password')->name('verify-code-reset-password');

Route::get('/check-reset-password/{verify_code}', 'AccountController@check_reset_password');

Route::post('/set-new-password', 'AccountController@set_new_password');