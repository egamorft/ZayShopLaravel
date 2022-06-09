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
Route::get('/home', 'HomeController@home');

Route::get('/about', 'HomeController@about');

Route::get('/contact', 'HomeController@contact');

Route::get('/shop', 'HomeController@shop');

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