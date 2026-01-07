<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nothing</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/css/quiz.css', 'resources/js/quiz.js'])
    @vite(['resources/css/option.css'])

</head>

<body>
    <div class="main_container">
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
    </div>
</body>

</html>
