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
        view()->composer('admin.dashboard.dashboard', function ($view) {

            $min_price = Product::where('product_status', '1')->min('product_price');
            $max_price = Product::where('product_status', '1')->max('product_price');

            $product_donut = Product::where('product_status', '1')->count();
            $order_donut = Order::count();
            $coupon_donut = Coupon::count();
            $account_donut = Account::count();
            $view->with(compact('product_donut', 'order_donut', 'coupon_donut', 'account_donut'));
        });

        // view()->composer('pages.public.shop', function ($view) {

        //     $min_price = Product::where('product_status', '1')->min('product_price');
        //     $max_price = Product::where('product_status', '1')->max('product_price');
        //     $view->with(compact('min_price', 'max_price'));
        // });
    }
}
