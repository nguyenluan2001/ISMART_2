@extends('layouts/admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách đơn hàng</h5>
            <div class="form-search form-inline">
                <form action="{{route('admin.order.search')}}" method="post">
                @csrf
                    <input type="text" name="key_word" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{route('admin.order.index')}}" class="text-primary">Tất cả<span class="text-muted">({{$processing_orders+$success_orders}})</span></a>
                <a href="{{route('admin.order.index',0)}}" class="text-primary">Đang xử lí<span class="text-muted">({{$processing_orders}})</span></a>
                <a href="{{route('admin.order.index',1)}}" class="text-primary">Thành công<span class="text-muted">({{$success_orders}})</span></a>
            </div>
            <form action="{{route('admin.order.action')}}" method="post">
                @csrf
                <div class="form-action form-inline py-3">
                    <select name="action" class="form-control mr-1" id="">
                        <option>Chọn</option>
                        <option value="1">Thành công</option>
                        <option value="2">Đang xử lí</option>
                        <option value="3">Xóa</option>
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">

                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Mã</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá trị</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count=0;
                        if(!isset($_GET['page']) || $_GET['page']==1)
                        {
                        $count=1;
                        }
                        else
                        {
                        $count=($_GET['page']-1)*$num_per_page+1;

                        }


                        @endphp
                        @foreach($orders as $key=>$item)
                        <tr>
                            <td>
                                <input type="checkbox" name="check[{{$item->id}}]">
                            </td>
                            <td>{{$count++}}</td>
                            <td>{{$item->code}}</td>
                            <td>
                                {{$item->customer_name}} <br>
                            </td>
                            <td><a href="#">{{$item->phone}}</a></td>
                            <td>{{$item->total_qty}}</td>
                            <td>{{number_format($item->total)}}₫</td>
                            <td>
                                @if($item->status==0)
                                <span class="badge badge-warning">Đang xử lý</span>
                                @else
                                <span class="badge badge-success">Thành công</span>

                                @endif
                            </td>
                            <td>{{$item->created_at}}</td>
                            <td>
                                <a href="{{route('admin.order.edit',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Bạn có muốn xóa đơn hàng này không?')" href="{{route('admin.order.delete',$item->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>

                        @endforeach


                    </tbody>
                </table>
                {{$orders->links()}}
            </form>

        </div>
    </div>
</div>
@endsection