@extends('layouts.main')
@section('content')
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="customer-info-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin khách hàng</h1>
            </div>
            <div class="section-detail">
                <form method="POST" action="{{route('order.store')}}" name="form-checkout">
                    @csrf
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="customer_name" id="fullname" value="{{old('customer_name')}}">
                        </div>
                        <div class="form-col fl-left">
                            <label for="">Xưng hô</label>
                            <input type="radio" name="gender" id="male" value="male">
                            <label for="male" class="d-inline-block">Anh</label>
                            <input type="radio" name="gender" id="female" value="female">
                            <label for="female" class="d-inline-block">Chị</label>
                        </div>

                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{old('email')}}">
                        </div>
                        <div class="form-col fl-right">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="phone" id="phone" value="{{old('phone')}}">
                        </div>
                    </div>
                    <div class="form-row clearfix" >
                        <div class="form-col fl-left" id="provinces">
                            <label for="address">Tỉnh/ Thành phố</label>
                            <select name="province" id="" class="custom-select">
                                @foreach($provinces as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="form-col fl-right" id="districts">
                            <label for="address">Quận/ Huyện</label>
                            <select name="district" id="" class="custom-select">
                                
                            </select>
                        </div>
                        <div class="form-col fl-left" id="wards">
                            <label for="address">Xã</label>
                            <select name="ward" id="" class="custom-select">
                                
                                </select>
                        </div>
                        <div class="form-col fl-left">
                            <label for="address">Số nhà/ Thôn</label>
                            <input type="text" name="address" id="address">
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col w-100">
                            <label for="notes">Ghi chú</label>
                            <textarea name="note" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="direct-payment" name="payment" value="direct_payment">
                                <label for="direct-payment">Thanh toán tại cửa hàng</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment" value="payment_home" checked="checked">
                                <label for="payment-home">Thanh toán tại nhà</label>
                            </li>
                        </ul>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" id="order-now" value="Đặt hàng">
                    </div>
                </form>
            </div>
        </div>
        <div class="section" id="order-review-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin đơn hàng</h1>
            </div>
            <div class="section-detail">
                <table class="shop-table">
                    <thead>
                        <tr>
                            <td>Sản phẩm</td>
                            <td>Tổng</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Cart::content() as $item)
                        <tr class="cart-item">
                            <td class="product-name">{{$item->name}}<strong class="product-quantity">x {{$item->qty}}</strong></td>
                            <td class="product-total">{{$item->subtotal(0)}}đ</td>
                        </tr>
                        @endforeach


                    </tbody>
                    <tfoot>
                        <tr class="order-total">
                            <td>Tổng đơn hàng:</td>
                            <td><strong class="total-price">{{Cart::total(0)}}đ</strong></td>
                        </tr>
                    </tfoot>
                </table>


            </div>
        </div>
    </div>
</div>
@endsection