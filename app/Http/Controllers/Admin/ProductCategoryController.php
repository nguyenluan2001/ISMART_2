<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProductCat;
use App\ProductSubCat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    function index()
    {
        $product_category=ProductCat::with('product_sub_cats')->get();
        return view('admin.products.category',compact('product_category'));
    }
    function store()
    {
        if(request()->category_id==0)
        {
            ProductCat::create([
                'product_cat_title'=>request()->title,
                'slug'=>Str::slug(request()->title)
            ]);
        }
        else
        {
            ProductSubCat::create([
                'product_sub_cat_title'=>request()->title,
                'slug'=>Str::slug(request()->title),
                'product_cat_id'=>request()->category_id
            ]);
        }
        return redirect()->route('admin.product.category.index');
    }
}
