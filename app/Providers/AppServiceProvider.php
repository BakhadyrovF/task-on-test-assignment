<?php

namespace App\Providers;

use App\Filters\ProductFilter;
use App\Models\Product;
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
        $this->app->bind(ProductFilter::class, function () {
            return new ProductFilter(Product::query());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        \DB::listen(function ($query) {
//            dump($query->sql);
//            dump($query->time);
//        });
    }
}
