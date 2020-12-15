<?php

namespace App\Providers;

use App\ProductCat;
use Illuminate\Support\Facades\View;
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
        View::composer(['admin.products.*'],function($view){
            $product_cats=ProductCat::all();
            $view->with(['product_cats'=>$product_cats]);

        });
        View::composer(['*'],function($view){
            $category=ProductCat::with('product_sub_cats')->with('products')->get();
             $view->with(['category'=>$category]);

        });
    }
}
