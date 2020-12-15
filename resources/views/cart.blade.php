@extends('layouts.main')
@section('content')
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Mã sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td colspan="2">Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Cart::content() as $item)
                        <tr>
                            <td>{{$item->options->product_code}}</td>
                            <td>
                                <a href="" title="" class="thumb">
                                    <img src="{{asset('public/uploads/products/'.$item->options->product_img)}}" alt="">
                                </a>
                            </td>
                            <td>
                                <a href="" title="" class="name-product">{{$item->name}}</a>
                            </td>
                            <td>{{number_format($item->price)}}đ</td>
                            <td>
                                <input id="qty" type="number" name="qty" data-id="{{$item->rowId}}" value="{{$item->qty}}" class="num-order" min="1" max="{{$item->options->qty}}">
                            </td>
                            <td ><p id="sub_total_{{$item->rowId}}">{{number_format($item->subtotal)}}Đ</p></td>
                            <td>
                                <a href="{{route('cart.delete',$item->rowId)}}" onclick="return confirm('Bạn có muốn xóa sản phẩm này không?')" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>

                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá: <span id="total">{{Cart::total(0)}}Đ</span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <a href="{{route('checkout.index')}}" title="" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <a href="{{route('index')}}" title="" id="buy-more">Mua tiếp</a><br />
                <a href="{{route('cart.delete')}}" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
    </div>
</div>
@endsection