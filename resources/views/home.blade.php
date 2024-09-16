<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang HOME</title>
</head>

<body>

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
</body>

</html>
