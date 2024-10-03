@extends('admin.layout')

@section('title', 'Thêm bài viết')

@section('content')
    <form action="{{ route('admin.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label">Title</label>
            <input type="text" class="form-control" id="" name="title" value="{{ $post->title }}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Image</label>
            <img src="{{ Storage::url($post->image) }}" width="60" alt="">
            <input type="file" class="form-control" name="image" id="">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Description</label>
            <textarea class="form-control" id="" name="description" rows="3">{{ $post->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">content</label>
            <textarea class="form-control" id="" name="content" rows="6">{{ $post->content }}</textarea>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Danh mục</label>
            <select name="category_id" id="" class="form-control">
                @foreach ($categories as $cate)
                    <option value="{{ $cate->id }}" @if ($cate->id == $post->category_id) selected @endif>
                        {{ $cate->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
