<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nothing</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/question_option.css'])
    {{-- @vite(['resources/css/category.css']) --}}

</head>

<body>
    <div class="main">
        <div class="option_form">
            <div class="option_text">
                <h1>Add a Option</h1>
            </div>

            <div class="option_alert">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-warning" role="alert">
                            <div class="alert-warning-message">
                                <strong>Error!</strong>
                                {{ $error }}
                            </div>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                <i class="ri-close-line"></i>
                            </button>
                        </div>
                    @endforeach
                @elseif(session('success'))
                    <div class="alert alert-success" role="alert">
                        <div class="alert-success-message">
                            <strong>Success!</strong>
                            {{ session('success') }}
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                @endif
            </div>
            <form action="{{ route('option.store') }}" method="POST" class="form" id="form" enctype="multipart/form-data">
                @csrf
                <div class="form_control">
                    <div class="select-wrapper">
                        <select name="question_id" id="select_question" required>
                            <option value="" id="default" disabled selected hidden>-- Select Question --</option>
                            @forelse ($questions as $question)
                                <option value="{{ $question->id }}">{{ $question->question }}</option>
                            @empty
                                <option value="" disabled>Not Record Found</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="form_control">
                    <label for="option_a">Option A</label>
                    <input type="text" name="option_a" id="option_a" placeholder="Enter Option A">
                </div>
                <div class="form_control">
                    <label for="option_b">Option B</label>
                    <input type="text" name="option_b" id="option_b" placeholder="Enter Option A">
                </div>
                <div class="form_control">
                    <label for="option_c">Option C</label>
                    <input type="text" name="option_c" id="option_c" placeholder="Enter Option A">
                </div>
                <div class="form_control">
                    <label for="option_d">Option D</label>
                    <input type="text" name="option_d" id="option_d" placeholder="Enter Option A">
                </div>
                <div class="form_control">
                    <label for="desc">Description</label>
                    <textarea name="desc" id="desc" cols="10" rows="5" placeholder="Description Here..."></textarea>
                </div>
                <div class="option_submit">
                    <button type="submit">Submit</button>
                    <a href="{{ route('result.index') }}">Create a Result?</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
