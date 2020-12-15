<?php

namespace App\Http\Controllers\Main;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCat;
use App\ProductSubCat;
use Illuminate\Http\Request;

class MainController extends Controller
{
    function index()
    {
        $category=ProductCat::with('product_sub_cats')->with('products')->get();
        $hot_sale_products=Product::orderBy('purchase','desc')->limit(5)->get();
        $product_category=ProductSubCat::with('products')->get();
        return view('home',compact('category','hot_sale_products','product_category'));
    }
}
