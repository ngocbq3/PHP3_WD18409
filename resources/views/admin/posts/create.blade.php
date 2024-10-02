@extends('admin.layout')

@section('title', 'Thêm bài viết')

@section('content')
    <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="" class="form-label">Title</label>
            <input type="text" class="form-control" id="" name="title" placeholder="title">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Image</label>
            <input type="file" class="form-control" name="image" id="">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Description</label>
            <textarea class="form-control" id="" name="description" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">content</label>
            <textarea class="form-control" id="" name="content" rows="6"></textarea>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Danh mục</label>
            <select name="category_id" id="" class="form-control">
                @foreach ($categories as $cate)
                    <option value="{{ $cate->id }}">
                        {{ $cate->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Create Post</button>
        </div>
    </form>
@endsection
