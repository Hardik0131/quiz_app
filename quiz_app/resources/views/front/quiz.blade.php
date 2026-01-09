@extends('front.layout.master')

@section('vite')
    @vite(['resources/css/quiz.css', 'resources/js/quiz.js', 'resources/css/front/home.css'])
    @vite(['resources/css/option.css'])
@endsection

@section('content')
    <div class="main_container">
        <div class="main_question_container">
            <div class="side_column_text">
                <h2>{{ $category->name }}</h2>
            </div>
            <div id="category_title">
                {{ $post->desc }}
            </div>
            <form action="{{ route('quiz.submit') }}" method="POST" id="form">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="question_container">

                    @foreach ($questions as $index => $question)
                        <div class="question_box" data-id="{{ $question->id }}">
                            <div class="question_number">
                                <h3>Q.{{ $index + 1 }} <span class="question_seprater">/
                                        <span>{{ $questions->count() }}</span></span></h3>
                            </div>
                            <div class="image_container">
                                <img src="{{ asset('images/question/' . $question->image) }}" alt="img">
                            </div>
                            <div class="question">
                                <h1>{{ $question->question }}</h1>
                            </div>
                            @if ($question->options)
                                <ul class="question_option">

                                    <li class="option">
                                        <input type="radio" value="1" id="q{{ $question->id }}_a"
                                            name="answers[{{ $question->id }}]">
                                        <label for="q{{ $question->id }}_a">{{ $question->options->option_a }}</label>
                                    </li>
                                    <li class="option">
                                        <input type="radio" value="2" id="q{{ $question->id }}_b"
                                            name="answers[{{ $question->id }}]">
                                        <label for="q{{ $question->id }}_a">{{ $question->options->option_b }}</label>
                                    </li>
                                    <li class="option">
                                        <input type="radio" value="3" id="q{{ $question->id }}_c"
                                            name="answers[{{ $question->id }}]">
                                        <label for="q{{ $question->id }}_a">{{ $question->options->option_c }}</label>
                                    </li>
                                    <li class="option">
                                        <input type="radio" value="4" id="q{{ $question->id }}_d"
                                            name="answers[{{ $question->id }}]">
                                        <label for="q{{ $question->id }}_a">{{ $question->options->option_d }}</label>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    @endforeach
                    <button class="question_submit" type="submit">Submit</button>
                </div>
            </form>
            <hr class="seprator">
            <div class="most_liked">
                <div class="bottom_column_text">
                    <h2>Content Must You Like</h2>
                </div>
                <div class="most_like">
                    @foreach ($posts as $post)
                        <a
                            href="{{ route('post.questions', [urlencode($post->category->name), urlencode($post->post_name)]) }}">
                            <div class="most_liked_posts">
                                <div class="most_liked_post_image">
                                    <img src="{{ asset('/images/category/' . $post->image) }}" alt="img">
                                </div>
                                <div class="most_like_text">
                                    <div class="most_like_category">
                                        {{ $post->category->name }}
                                    </div>
                                    <div class="most_like_desc">
                                        <h1>{{ $post->desc }}</h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="quiz_trending">
            <div class="quiz_side_column_text">
                <h2>Trending</h2>
            </div>
            @foreach ($posts as $index => $post)
                <a href="{{ route('post.questions', [urlencode($post->category->name), urlencode($post->post_name)]) }}">
                    <div class="quiz_trending_post">
                        <div class="quiz_trending_post_image">
                            <img src="{{ asset('/images/category/' . $post->image) }}" alt="img">
                        </div>
                        <div class="quiz_trending_post_text">
                            <div class="quiz_trending_post_count">
                                <h2>{{ $index + 1 }}</h2>
                            </div>
                            <div class="quiz_trending_post_category">
                                <p>{{ $post->category->name }}</p>
                                <h1>{{ $post->desc }}</h1>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
