<?php

namespace App\Providers;

use App\Page;
use App\Product;
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
            $pages=Page::all();
            $hot_sale_products=Product::orderBy('purchase','desc')->limit(5)->get();
             $view->with(['category'=>$category]);
             $view->with(['pages'=>$pages]);
             $view->with(['hot_sale_products'=>$hot_sale_products]);

        });
    }
}
