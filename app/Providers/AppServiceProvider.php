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

            $product_donut = Product::all()->where('product_status', '1')->count();
            $order_donut = Order::all()->count();
            $coupon_donut = Coupon::all()->count();
            $account_donut = Account::all()->count();
            $view->with(compact('min_price', 'max_price', 'product_donut', 'order_donut', 'coupon_donut', 'account_donut'));
        });
    }
}
