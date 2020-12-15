<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCat;
use Illuminate\Http\Request;

class MainProductController extends Controller
{
    function product_by_category($product_cat_slug, $product_sub_cat_slug)
    {
        $product_cat = ProductCat::whereSlug($product_cat_slug)->get()[0];
        $product_sub_cat = $product_cat->product_sub_cats()->whereSlug($product_sub_cat_slug)->get()[0];
        $products = Product::where([
            [
                'product_cat_id',
                $product_cat->id
            ],
            [
                'product_sub_cat_id',
                $product_sub_cat->id
            ]
        ])->paginate(4);
        return view('category_product', compact('products', 'product_sub_cat'));
    }
    function show($product_slug)
    {
        $product = Product::whereSlug($product_slug)->get()[0];
        $product_same_category=Product::where([['product_sub_cat_id',$product->product_sub_cat_id],['id','<>',$product->id]])->limit(5)->get();
        return view('detail_product', compact('product','product_same_category'));
    }
    function product_by_category_filter($product_cat_slug, $product_sub_cat_slug)
    {
        $product_cat = ProductCat::whereSlug($product_cat_slug)->get()[0];
        $product_sub_cat = $product_cat->product_sub_cats()->whereSlug($product_sub_cat_slug)->get()[0];
        $filter=request()->filter;
        $products=[];
        if ($filter == 1) {
            $products = Product::where([
                [
                    'product_cat_id',
                    $product_cat->id
                ],
                [
                    'product_sub_cat_id',
                    $product_sub_cat->id
                ]
            ])->orderBy('product_name')->paginate(4);
        }
        else if($filter==2)
        {
            $products = Product::where([
                [
                    'product_cat_id',
                    $product_cat->id
                ],
                [
                    'product_sub_cat_id',
                    $product_sub_cat->id
                ]
            ])->orderBy('product_name','desc')->paginate(4);
        }
        else if($filter==3)
        {
            $products = Product::where([
                [
                    'product_cat_id',
                    $product_cat->id
                ],
                [
                    'product_sub_cat_id',
                    $product_sub_cat->id
                ]
            ])->orderBy('price','desc')->paginate(4);
        }
        else if($filter==4)
        {
            $products = Product::where([
                [
                    'product_cat_id',
                    $product_cat->id
                ],
                [
                    'product_sub_cat_id',
                    $product_sub_cat->id
                ]
            ])->orderBy('price')->paginate(4);
        }
        return view('category_product', compact('products', 'product_sub_cat','filter'));
    }
}
