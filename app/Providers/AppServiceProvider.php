<?php

namespace App\Providers;

use App\Account;
use App\Coupon;
use App\Order;
use App\Product;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {

            $min_price = Product::where('product_status', '1')->min('product_price');
            $max_price = Product::where('product_status', '1')->max('product_price');

            $product = Product::all()->where('product_status', '1')->count();
            $order = Order::all()->count();
            $coupon = Coupon::all()->count();
            $account = Account::all()->count();
            $view->with(compact('min_price', 'max_price', 'product', 'order', 'coupon', 'account'));
        });
    }
}
