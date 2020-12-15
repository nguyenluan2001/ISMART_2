@extends('layouts/admin')
@section('content')
<div id="content" class="container-fluid">
                    <div class="card">
                        <div class="card-header font-weight-bold">
                            Sửa trang
                        </div>
                        <div class="card-body">
                          
                            <form action="{{route('admin.page.update',$page[0]->slug)}}" method="post">
                                @csrf 
                                <div class="form-group">
                                    <label for="name">Tiêu đề </label>
                                    <input class="form-control" type="text" name="title" id="name" value="{{$page[0]->title}}">
                                </div>
                                <div class="form-group">
                                    <label for="content">Nội dung</label>
                                    <textarea name="content" class="form-control ckeditor" id="content" cols="30" rows="5">{{$page[0]->content}}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
@endsection