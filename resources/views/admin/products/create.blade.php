@extends('layouts/admin')
@section('content')
<script>
    $(document).ready(function() {

    })
</script>
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">
            <form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input class="form-control" type="text" name="product_name" id="name" value="{{old('product_name')}}">
                </div>
                <div class="form-group">
                    <label for="name">Mã sản phẩm</label>
                    <input class="form-control" type="text" name="product_code" id="name" value="{{old('product_code')}}">
                </div>
                <div class="form-group">
                    <label for="name">Giá</label>
                    <input class="form-control" type="text" name="price" id="name" value="{{old('price')}}">
                </div>
                <div class="form-group">
                    <label for="name">Số lượng</label>
                    <input class="form-control" type="text" name="qty" id="name" value="{{old('qty')}}">
                </div>
                <div class="form-group">
                    <label for="intro">Mô tả sản phẩm</label>
                    <textarea name="product_desc" class="form-control ckeditor" id="product_desc" cols="30" rows="5">{{old('product_desc')}}</textarea>
                </div>
                <div class="form-group">
                    <label for="intro">Chi tiết sản phẩm</label>
                    <textarea name="product_detail" class="form-control ckeditor" id="product_detail" cols="30" rows="5">{{old('product_detail')}}</textarea>
                </div>


                <div class="form-group" id="product_cat">
                    <label for="">Danh mục cha</label>
                    <select class="form-control" id="" name="product_cat_id">
                        @foreach($product_cats as $item)
                        <option value="{{$item->id}}" @if($item->id==old('product_cat_id')) selected="selected" @endif>{{$item->product_cat_title}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group" id="product_sub_cat">
                    <label for="">Danh mục con</label>
                    <select class="form-control" id="" name="product_sub_cat_id">
                        <option>Chọn danh mục</option>
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
                    <label for="">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Chờ duyệt
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                        <label class="form-check-label" for="exampleRadios2">
                            Công khai
                        </label>
                    </div>
                </div>



                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection