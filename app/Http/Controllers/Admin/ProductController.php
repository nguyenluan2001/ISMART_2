<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    function index($status=null)
    {
        $num_per_page=5;
        $products=[];
        if($status==null)
        {
            $products=Product::orderBy('id','desc')->paginate($num_per_page);

        }
        if($status=='1')
        {
            $products=Product::where('qty','>','0')->paginate($num_per_page);

        }
        if($status=='0')
        {
            $products=Product::where('qty','0')->paginate($num_per_page);

        }
         if(session('product_search'))
        {
            $products=session('product_search');
        }
        $stocking=Product::where('qty','>',0)->count();
        $outOfStock=Product::where('qty',0)->count();
        return view('admin.products.index',compact('products','stocking','outOfStock'));
    }
    function create()
    {
        $product_cats=ProductCat::all();
        return view('admin.products.create',compact('product_cats'));
    }
    function store()
    {
        $data=request()->validate([
            'product_name'=>'required',
            'product_code'=>'required',
            'price'=>'required',
            'qty'=>'required',
            'product_desc'=>'required',
            'product_detail'=>'required',
            'product_cat_id'=>'required',
            'product_sub_cat_id'=>'required',
            'product_img'=>'required|image'
        ]);
        $data['slug']=Str::slug($data['product_name']);
        $file=request()->file('product_img');
        $data['product_img']=$file->getClientOriginalName();
        $file->move('public/uploads/products',$file->getClientOriginalName());
        $img=Image::make('public/uploads/products/'.$file->getClientOriginalName())->fit(300,300);
        $img->save();
        Product::create($data);
        return redirect()->route('admin.product.index');

    }
    function edit($slug)
    {
        $product=Product::whereSlug($slug)->get();
        return view('admin.products.edit',compact('product'));
    }
    function update(Product $product)
    {
        $data=request()->all();
        $data['slug']=Str::slug($data['product_name']);
        
        if(request()->hasFile('product_img'))
        {
            $file=request()->file('product_img');
            $data['product_img']=$file->getClientOriginalName();
            $file->move('public/uploads/products',$file->getClientOriginalName());
            $img=Image::make('public/uploads/products/'.$file->getClientOriginalName())->fit(300,300);
            $img->save();


        }
        $product->update($data);
        return back();
    }
    function delete(Product $product)
    {
        $product->delete();
        return back();
    }
    function search()
    {
        $key_word=request()->key_word;
        $product=Product::where('product_name','like',"%$key_word%")->paginate(5);
        return redirect()->route('admin.product.index')->with('product_search',$product);
    }
}
