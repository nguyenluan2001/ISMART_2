<?php

namespace App\Http\Controllers\Main;

use App\DetailOrder;
use App\District;
use App\Events\CheckOutSuccessEvent;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\Province;
use App\Ward;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MainOrderController extends Controller
{
    function store()
    {
        $data=request()->validate([
            'customer_name'=>'required',
            'gender'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'province'=>'required',
            'district'=>'required',
            'address'=>'required',
            'ward'=>'required',
            'payment'=>'required',
        ]);
        $data['code']='LA-'. Str::upper(Str::random(6));
        $data['province']=Province::find($data['province'])->name;
        $data['district']=District::find($data['district'])->name;
        $data['ward']=Ward::find($data['ward'])->name;
        $data['note']=request()->note;
        $data['total']=Cart::total(0,'','');
        $data['total_qty']=Cart::count();
        $order=Order::create($data);
        foreach(Cart::content() as $item)
        {
            $detail_order=new DetailOrder();
            $detail_order->order_id=$order->id;
            $detail_order->product_id=$item->id;
            $detail_order->qty=$item->qty;
            $detail_order->subtotal=$item->subtotal;
            $detail_order->save();
            $product=Product::find($item->id);
            $product->qty=$product->qty-$item->qty;
            $product->purchase=$product->purchase+$item->qty;
            $product->save();


        }
        $x['cart']=Cart::content();
        $x['more_info']=$order;
        session(['order'=>$x]);
        event(new CheckOutSuccessEvent($x));

        return redirect()->route('checkout.success');
       
    }
}
