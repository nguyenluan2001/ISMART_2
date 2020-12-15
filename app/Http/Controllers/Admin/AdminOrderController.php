<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    function index()
    {
        $num_per_page=5;
        $orders=Order::orderBy('id','desc')->paginate($num_per_page);
        return view('admin.orders.index',compact('orders','num_per_page'));
    }
    function edit(Order $order)
    {
        $order->load('detail_orders.product');
        return view('admin.orders.edit',compact('order')) ;
    }
    function update(Order $order)
    {
        $order->status=request()->status;
        $order->save();
        return back();
    }
    function delete(Order $order)
    {
        $order->delete();
        return back();
    }
    function action()
    {
        if(request()->action=='1')// thành công
        {
            foreach(request()->check as $key=>$item)
            {
                $order=Order::find($key);
                $order->status='1';
                $order->save();

            }
        }
        else if(request()->action=='2')// đang xử lí
        {
            foreach(request()->check as $key=>$item)
            {
                $order=Order::find($key);
                $order->status='0';
                $order->save();

            }
        }
        else if(request()->action=='3')//Xóa
        {
            foreach(request()->check as $key=>$item)
            {
                $order=Order::find($key);
                $order->delete();
              

            }
        }
        return back();
    }
}
