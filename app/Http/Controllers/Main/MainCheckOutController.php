<?php

namespace App\Http\Controllers\Main;

use App\District;
use App\Http\Controllers\Controller;
use App\Province;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class MainCheckOutController extends Controller
{
    function index()
    {
        $provinces=Province::all();
        return view('checkout',compact('provinces'));
    }
    function ajax_district()
    {
        $districts=Province::find(request()->province_id)->districts;
        $html="";
        foreach($districts as $item)
        {
            $html.="<option value='{$item->id}'>{$item->name}</option>";

        }
        echo $html;
    }
    function ajax_ward()
    {
        $wards=District::find(request()->district_id)->wards;
        $html="";
        foreach($wards as $item)
        {
            $html.="<option value='{$item->id}'>{$item->name}</option>";

        }
        echo $html;
    }
    function checkout_success()
    {
        $order=session('order');
        // return $order['more_info']['phone'];
        return view('checkout_success',compact('order'));
    }
}
