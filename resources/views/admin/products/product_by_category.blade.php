@extends('layouts/admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách sản phẩm</h5>
            <div class="form-search form-inline">
                <form action="{{route('admin.product.search')}}" method="post">
                @csrf
                    <input type="text" name="key_word" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{route('admin.product.product_by_category',[$product_cat_slug,$product_sub_cat_slug])}}" class="text-primary">Tất cả<span class="text-muted">({{$stocking+$outOfStock}})</span></a>
                <a href="{{route('admin.product.product_by_category',[$product_cat_slug,$product_sub_cat_slug,1])}}" class="text-primary">Còn hàng<span class="text-muted">({{$stocking}})</span></a>
                <a href="{{route('admin.product.product_by_category',[$product_cat_slug,$product_sub_cat_slug,0])}}" class="text-primary">Hết hàng<span class="text-muted">({{$outOfStock}})</span></a>
            </div>
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="">
                    <option>Chọn</option>
                    <option>Tác vụ 1</option>
                    <option>Tác vụ 2</option>
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key=>$item)
                    <tr class="">
                        <td>
                            <input type="checkbox">
                        </td>
                        <td>{{$key+1}}</td>
                        <td><img src="{{url('public/uploads/products/'.$item->product_img)}}" style="width:100px" alt=""></td>
                        <td><a href="#">{{$item->product_name}}</a></td>
                        <td>{{number_format($item->price)}}₫</td>
                        <td>{{$item->product_sub_cat->product_sub_cat_title}}</td>
                        <td>{{$item->qty}}</td>
                        <td>
                            @if($item->qty>0)
                            <span class="badge badge-success">Còn hàng</span>
                            @else
                            <span class="badge badge-dark">Hết hàng</span>

                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.product.edit',$item->slug)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{route('admin.product.delete',$item->id)}}" onclick="return confirm('Bạn có muốn xóa sản phẩm này không?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
            {{$products->links()}}
        </div>
    </div>
</div>
@endsection