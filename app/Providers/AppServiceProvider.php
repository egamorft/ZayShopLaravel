<?php

namespace App\Providers;

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
            $view->with(compact('min_price', 'max_price'));
        });
    }
}
