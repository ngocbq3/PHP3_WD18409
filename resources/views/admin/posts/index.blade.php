@extends('admin.layout')

@section('title', 'Danh sách bài viết')

@section('content')

    <div class="m-5">
        <table class="table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Category Name</th>
                    <th>
                        <a href="#" class="btn btn-primary">Thêm</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>
                            <img src="{{ $post->image }}" width="60" alt="">
                        </td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->category_id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $posts->links() }}
    </div>

@endsection
