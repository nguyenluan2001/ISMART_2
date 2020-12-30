<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    function index($status = null)
    {
       
        $num_per_page = 5;
        $orders=[];
        if ($status === null) {
            $orders = Order::orderBy('id', 'desc')->paginate($num_per_page);
        }
        else if($status!=null)
        {
            $orders=Order::whereStatus($status)->paginate($num_per_page);

        }
        if(session('order_search'))
        {
            $orders= session('order_search');
        }
        $success_orders = Order::whereStatus('1')->count();
        $processing_orders = Order::all()->count() - $success_orders;
        return view('admin.orders.index', compact('orders', 'num_per_page', 'success_orders', 'processing_orders'));
    }
    function edit(Order $order)
    {
        $order->load('detail_orders.product');
        return view('admin.orders.edit', compact('order'));
    }
    function update(Order $order)
    {
        $order->status = request()->status;
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
        if (request()->action == '1') // thành công
        {
            foreach (request()->check as $key => $item) {
                $order = Order::find($key);
                $order->status = '1';
                $order->save();
            }
        } else if (request()->action == '2') // đang xử lí
        {
            foreach (request()->check as $key => $item) {
                $order = Order::find($key);
                $order->status = '0';
                $order->save();
            }
        } else if (request()->action == '3') //Xóa
        {
            foreach (request()->check as $key => $item) {
                $order = Order::find($key);
                $order->delete();
            }
        }
        return back();
    }
    function search()
    {
        $key_word=request()->key_word;
        $order=Order::where('customer_name','like',"%$key_word%")->paginate(1);
        return redirect()->route('admin.order.index')->with('order_search',$order);
    }
}
