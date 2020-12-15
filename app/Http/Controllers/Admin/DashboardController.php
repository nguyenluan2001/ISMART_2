<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function dashboard()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(10);
        $success_orders = Order::whereStatus('1')->count();
        $processing_orders=Order::all()->count()-$success_orders;
        $revenue=Order::whereStatus('1')->sum('total');
        return view('admin.dashboard', compact('orders','success_orders','processing_orders','revenue'));
    }
}
