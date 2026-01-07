<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz Time</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/front/result.css'])
</head>

<body>

    <div class="result_container">
        <div class="post_name_container">
            <h1 class="post_name">{{ $post->post_name }} - Result</h1>
        </div>
        @if($result)
            <h2>{{ $result->desc }}</h2>
        @endif
        <a href="{{ route('category.index') }}">Back to Home.</a>
    </div>

    {{-- <h1>{{ $post->post_name }} – Result</h1>

    <p><strong>Your Score:</strong> {{ $score }}</p>

    @if ($result)
        <h2>{{ $result->title }}</h2>
        <p>{{ $result->desc }}</p>
    @else
        <p>No result defined for this score.</p>
    @endif

    <a href="{{ route('category.index') }}">Back</a> --}}

</body>

</html>
