<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class MainBlogController extends Controller
{
    function index()
    {
        $posts=Post::orderBy('id','desc')->paginate(5);
        return view('blog',compact('posts'));
    }
    function show($slug)
    {
        $post=Post::where('slug',$slug)->get()[0];
        $post->view=$post->view+1;
        $post->save();
        return view('detail_blog',compact('post'));
    }
}
