@extends('layouts.dashboard')
@section('title', 'Edit Category')
@section('content')
    <div class="container-full">
        <h2 class="text-center mt-4">Edit danh mục</h2>
        <div class="container">
            <form action="{{asset('/update-category/'.$edit_cate->category_id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="category_name" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" name="category_name" id="category_name" value="{{$edit_cate->category_name}}" placeholder="Nhập tên danh mục">
                </div>
                <div class="mb-3">
                    <label for="category_desc" class="form-label">Mô tả danh mục</label>
                    <textarea class="form-control" name="category_desc" id="category_desc" rows="3">{{$edit_cate->category_desc}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="category_image" class="form-label">Ảnh danh mục</label>
                    <input class="form-control" name="category_image" type="file" id="category_image">
                    <img src="{{URL::to('uploads/category/'.$edit_cate->category_image)}}" height="100" width="100">
                </div>
                <button class="btn btn-success" type="submit">Sửa danh mục</button>
            </form>
        </div>
    </div>

@endsection
