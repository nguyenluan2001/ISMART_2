@extends('layouts/main')
@section('content')
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach($posts as $item)
                        <li class="clearfix">
                            <a href="{{route('blog.show',$item->slug)}}" title="" class="thumb fl-left">
                                <img src="{{asset('public/uploads/posts/'.$item->post_img)}}" class="w-100" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="{{route('blog.show',$item->slug)}}" title="" class="title">{{$item->post_title}}</a>
                                <span class="create-date d-inline-block">{{$item->created_at->format('d/m/Y')}}</span>
                                <span class="text-muted"><i class="far fa-eye"></i> {{$item->view}}</span>
                                <p class="desc">{!!$item->post_desc!!}</p>
                            </div>
                        </li>
                        @endforeach


                    </ul>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">1</a>
                        </li>
                        <li>
                            <a href="" title="">2</a>
                        </li>
                        <li>
                            <a href="" title="">3</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach($hot_sale_products as $item)
                        <li class="clearfix">
                            <a href="{{route('product.show',$item->slug)}}" title="" class="thumb fl-left">
                                <img src="{{asset('public/uploads/products/'.$item->product_img)}}" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="{{route('product.show',$item->slug)}}" title="" class="product-name">{{$item->product_name}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($item->price)}}đ</span>
                                    <span class="old">7.190.000đ</span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>

                        @endforeach


                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_blog_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection