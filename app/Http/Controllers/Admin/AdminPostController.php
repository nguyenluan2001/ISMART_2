<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AdminPostController extends Controller
{
    function index()
    {
        $num_per_page=5;
        $posts=Post::orderBy('id','desc')->paginate($num_per_page);
        return view('admin.posts.index',compact('posts'));

    }
    function create()
    {
        return view('admin.posts.create');
    }
    function store()
    {
        $data = request()->validate(
            [
                'post_title' => 'required',
                'post_content' => 'required',
                'post_img' => 'required',
            ]
        );
        $data['slug'] = Str::slug($data['post_title']);
        $data['post_desc'] = Str::of($data['post_content'])->limit(50);
        $file = request()->file('post_img');
        $data['post_img'] = $file->getClientOriginalName();
        $file->move('public/uploads/posts',$data['post_img']);
        $img=Image::make('public/uploads/posts/'.$data['post_img'])->fit(300,300);
        $img->save();
        Post::create($data);
        return redirect()->route('admin.post.index');
    }
    function edit(Post $post)
    {

        return view('admin.posts.edit',compact('post'));
    }
    function update(Post $post)
    {
        $post->post_title=request()->post_title;
        $post->slug=Str::slug(request()->post_title);
        $post->post_content=request()->post_content;
        $post->post_desc=Str::of(request()->post_content)->limit(50);
        if(request()->hasFile('post_img'))
        {
            $file=request()->file('post_img');
            $post->post_img=$file->getClientOriginalName();
            $file->move('public/uploads/posts',$file->getClientOriginalName());
            $img=Image::make('public/uploads/posts/'.$file->getClientOriginalName())->fit(300,300);
            $img->save();
        }
        $post->save();
        return back();
    }
}
