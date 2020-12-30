<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    function index($slug)
    {
        $page=Page::whereSlug($slug)->get()[0];
        return view('detail_page',compact('page'));
    }
}
