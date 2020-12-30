@extends('layouts/admin')
@section('content')
</script>
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Sửa sản phẩm
        </div>
        <div class="card-body">
            <form action="{{route('admin.product.update',$product[0]->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input class="form-control" type="text" name="product_name" id="name" value="{{$product[0]->product_name}}">
                </div>
                <div class="form-group">
                    <label for="name">Mã sản phẩm</label>
                    <input class="form-control" type="text" name="product_code" id="name" value="{{$product[0]->product_code}}">
                </div>
                <div class="form-group">
                    <label for="name">Giá</label>
                    <input class="form-control" type="text" name="price" id="name" value="{{$product[0]->price}}">
                </div>
                <div class="form-group">
                    <label for="name">Số lượng</label>
                    <input class="form-control" type="text" name="qty" id="name" value="{{$product[0]->qty}}">
                </div>
                <div class="form-group">
                    <label for="intro">Mô tả sản phẩm</label>
                    <textarea name="product_desc" class="form-control ckeditor" id="product_desc" cols="30" rows="5">{{$product[0]->product_desc}}</textarea>
                </div>
                <div class="form-group">
                    <label for="intro">Chi tiết sản phẩm</label>
                    <textarea name="product_detail" class="form-control ckeditor" id="product_detail" cols="30" rows="5">{{$product[0]->product_detail}}</textarea>
                </div>


                <div class="form-group" id="product_cat">
                    <label for="">Danh mục cha</label>
                    <select class="form-control" id="" name="product_cat_id">
                        @foreach($product_cats as $item)
                        <option value="{{$item->id}}" @if($item->id==$product[0]->product_cat_id) selected="selected" @endif>{{$item->product_cat_title}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group" id="product_sub_cat">
                    <label for="">Danh mục con</label>
                    <select class="form-control" id="" name="product_sub_cat_id">
                        @foreach($product[0]->product_cat->product_sub_cats as $value)
                        <option value="{{$value->id}}" @if($value->id==$product[0]->product_sub_cat->id) selected="selected" @endif >{{$value->product_sub_cat_title}}</option>

                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <p>Hình ảnh</p>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file" name="product_img">
                        <label for="file" class="custom-file-label">Choose file</label>
                    </div>
                </div>
                <div class="form-group">
                    <img src="{{asset('public/uploads/products/'.$product[0]->product_img)}}" alt="">
                </div>


            



                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection