@extends('layouts/admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm danh mục
                </div>
                <div class="card-body">
                    <form action="{{route('admin.product.category.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" type="text" name="title" id="name">
                        </div>
                        <div class="form-group">
                            <label for="">Danh mục cha</label>
                            <select class="form-control" id="" name="category_id">
                                <option value="0" selected='selected'>Không</option>
                                @foreach($product_category as $item)
                                <option value="{{$item->id}}">{{$item->product_cat_title}}</option>
                                @endforeach
                            </select>
                        </div>                  
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh mục
                </div>
                <div class="card-body">
                    @foreach($product_category as $item)
                    <h5>===== {{$item->product_cat_title}}</h5>
                    @foreach($item['product_sub_cats'] as $value)
                    <h5>------------- {{$value['product_sub_cat_title']}}</h5>

                    @endforeach

                    @endforeach
                   
                   
                </div>
            </div>
        </div>
    </div>

</div>
@endsection