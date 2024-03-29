<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('coupons', 'CouponController');

Route::resource('categories', 'CategoryController');

Route::resource('subcategories', 'SubCategoryController');

Route::post('sliders/{slider}/recreate', 'SliderController@recreate')->name('sliders.recreate');

Route::resource('sliders', 'SliderController');

Route::resource('address', 'AddressController');

Route::resource('city', 'CityController');

Route::resource('province', 'ProvinceController');

Route::resource('ward', 'WardController');