@extends('layouts/admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Cập nhật đơn hàng</h5>
        </div>
        <div class="card-body">
            <div id="info_order">
                <h5>Thông tin đơn hàng</h5>
                <p><strong>Mã đơn hàng: {{$order->code}}</strong></p>
                <p><strong>Họ tên: {{$order->customer_name}}</strong></p>
                <p><strong>Giới tính: {{$order->gender}}</strong></p>
                <p><strong>Số điện thoại: {{$order->phone}}</strong></p>
                <p><strong>Email: {{$order->email}}</strong></p>
                <p><strong>Điaj chỉ: {{$order->address.', '.$order->ward.', '.$order->district.', '.$order->province}}</strong></p>
                <p><strong>Ghi chú: {{$order->note}}</strong></p>
                <p><strong>Hình thức thanh toán: {{$order->payment}}</strong></p>
                <form action="{{route('admin.order.update',$order->id)}}" method="post">
                    @csrf
                    <label for="">Trạng thái đơn hàng</label>
                    <select name="status" id="">
                        <option value="0" @if($order->status==0) selected='selected' @endif>Đang xử lí</option>
                        <option value="1" @if($order->status==1) selected='selected' @endif>Thành công</option>
                    </select>
                    <button class="btn btn-primary">Cập nhật</button>
                </form>

            </div>
            <div id="list_products">
                <h5>Danh sachs sản phẩm</h5>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Mã</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá thành</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->detail_orders as $key=>$item)
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>{{$key+1}}</td>
                            <td>{{$item->product->product_code}}</td>
                            <td>
                                <img src="{{asset('public/uploads/products/'.$item->product->product_img)}}" width="100px" alt="">
                            </td>
                            <td>{{$item->product->product_name}}</td>
                            <td>{{$item->qty}}</td>
                            <td>{{number_format($item->product->price)}}Đ</td>
                            <td>{{number_format($item->subtotal)}}Đ</td>
                            <td></td>
                            <td>
                                <a href="" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection