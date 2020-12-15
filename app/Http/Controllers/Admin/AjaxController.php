<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProductSubCat;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    function product_category()
    {
        $product_sub_cats=ProductSubCat::where('product_cat_id',request()->product_cat_id)->get();
        $html="";
        foreach($product_sub_cats as $item)
        {
            $html.="<option value='{$item->id}'>{$item->product_sub_cat_title}</option>";
        }

        echo $html;
    }
}
