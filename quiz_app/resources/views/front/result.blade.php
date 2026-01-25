@extends('front.layout.master')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/front/result.css'])
@endsection

@section('content')
    <div class="main-result-page">
        <div class="result_container">
            @if (!empty($result?->image))
                <img src="{{ asset('storage/' . $result->image) }}" alt="result Image">
            @else
                <h1>Image Not Found</h1>
            @endif
            <div class="post_name_container">
                <div class="quiz_result">
                    <h1 class="post_name">{{ $post->post_name }} - Result</h1>
                    @if ($result)
                        <h2>{{ $result->title }}</h2>
                    @else
                        <h2>Congratulation You Pass the Test.</h2>
                    @endif
                </div>
                <a href="{{ route('category.index') }}">Back to Home.</a>
            </div>
        </div>
    </div>
@endsection
