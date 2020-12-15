<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class MainCartController extends Controller
{
    function index()
    {
        return view('cart');
    }
    function add(Product $product)
    {
        Cart::add([
            'id'=>$product->id,
            'name'=>$product->product_name,
            'qty'=>request()->qty,
            'price'=>$product->price,
            'options'=>[
                'product_code'=>$product->product_code,
                'product_img'=>$product->product_img,
                'qty'=>$product->qty

            ]
        ]);
        return redirect()->route('cart.index');
    }
    function ajax()
    {
       Cart::update(request()->rowId,request()->qty);
       $data=[
           'rowId'=>request()->rowId,
           'qty'=>request()->qty,
           'sub_total'=>Cart::get(request()->rowId)->subtotal(0).'Đ',
           'total'=>Cart::total(0).'Đ'
       ];
       return json_encode($data);
    }
    function delete($rowId="")
    {
        if($rowId=="")
        {
            Cart::destroy();
        }
        else
        {
            Cart::remove($rowId);
        }
        return redirect()->back();
    }
}
