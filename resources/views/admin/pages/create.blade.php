@extends('layouts/admin')
@section('content')
<div id="content" class="container-fluid">
                    <div class="card">
                        <div class="card-header font-weight-bold">
                            Thêm bài viết
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.page.store')}}" method="post">
                                @csrf 
                                <div class="form-group">
                                    <label for="name">Tiêu đề </label>
                                    <input class="form-control" type="text" name="title" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="content">Nội dung</label>
                                    <textarea name="content" class="form-control ckeditor" id="content" cols="30" rows="5"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </form>
                        </div>
                    </div>
                </div>
@endsection