@extends('layout')

@section('title', 'Trang chủ website')

@section('content')

    @foreach ($posts as $post)
        <div>
            <a href="#">
                <h3>{{ $post->title }}</h3>
                <p>
                    {{ $post->description }}
                </p>
            </a>
            <hr>
        </div>
    @endforeach


@endsection
