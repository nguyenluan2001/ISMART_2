<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    function index()
    {
        $pages=Page::orderBy('id','desc')->get();
        return view('admin.pages.index',compact('pages'));
    }
    function create()
    {
        return view('admin.pages.create');
    }
    function store()
    {
       $data=request()->validate([
           'title'=>'required',
           'content'=>'required',
       ]);
       $data['slug']=Str::slug($data['title']);
       Page::create($data);
       return redirect()->route('admin.page.index');
    }
    function edit($slug)
    {
        $page=Page::whereSlug($slug)->get();
        return view('admin.pages.edit',compact('page'));

    }
    function update($slug)
    {
        $page=Page::whereSlug($slug)->get();
        $page[0]->title=request()->title;
        $page[0]->content=request()->content;
        $page[0]->slug=Str::slug(request()->title);
        $page[0]->save();
        return redirect()->route('admin.page.index')->with('edit_success','Đã sửa thành công');
    }
    function delete($slug)
    {
        Page::whereSlug($slug)->delete();
        return back()->with('delete_success','Đã xóa thành công');
    }
}
