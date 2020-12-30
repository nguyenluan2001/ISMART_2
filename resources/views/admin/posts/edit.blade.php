@extends('layouts/admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            <form action="{{route('admin.post.update',$post->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Tiêu đề </label>
                    <input class="form-control" type="text" name="post_title" id="name" value="{{$post->post_title}}">
                </div>
                <div class="form-group">
                    <label for="content">Nội dung</label>
                    <textarea name="post_content" class="form-control ckeditor" id="post_content" cols="30" rows="5">{{$post->post_content}}</textarea>
                </div>
                <div class="form-group custom-file mb-3">
                    <input type="file" name="post_img" class="custom-file-input" id="file">
                    <label for="file" class="custom-file-label">Choose file</label>
                </div>

                @if($post->post_img)
                <div class="form-group">
                    <img src="{{asset('public/uploads/posts/'.$post->post_img)}}" alt="">

                </div>

                @endif
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection