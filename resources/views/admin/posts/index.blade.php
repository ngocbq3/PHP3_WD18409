@extends('admin.layout')

@section('title', 'Danh sách bài viết')

@section('content')

    <div class="m-5">
        @if (session('message'))
            <div class="alert bg-primary text-white">
                {{ session('message') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Category Name</th>
                    <th>
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Thêm</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>
                            <img src="{{ Storage::url($post->image) }}" width="60" alt="">
                        </td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td class="d-flex">
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary mx-1">Edit</a>

                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $posts->links() }}
    </div>

@endsection
