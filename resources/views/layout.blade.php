<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> PHP3 - @yield('title') </title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <nav>
        @foreach ($categories as $cate)
            <a href="{{ route('page.list', $cate->id) }}">{{ $cate->name }}</a>
        @endforeach
    </nav>

    @yield('content')

    <footer>
        FOOTER
    </footer>
</body>

</html>
