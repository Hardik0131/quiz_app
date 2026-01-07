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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/postresult.css'])
    {{-- @vite(['resources/css/category.css']) --}}

</head>

<body>
    <div class="main">
        <div class="result_form">
            <div class="result_text">
                <h1>Create A Score Criteria</h1>
            </div>

            <div class="result_alert">
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
            <form action="{{ route('result.store') }}" method="POST" class="form" id="form"
                enctype="multipart/form-data">
                @csrf
                <div class="form_control">
                    <div class="select-wrapper">
                        <select name="post_id" id="select_question" required>
                            <option value="" id="default" disabled selected hidden>-- Select Question --
                            </option>
                            @forelse ($posts as $post)
                                <option value="{{ $post->id }}">{{ $post->post_name }}</option>
                            @empty
                                <option value="" disabled>Not Record Found</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="form_control">
                    <label for="min_val">Min Score</label>
                    <input type="text" name="min_score" id="min_score" placeholder="Enter Min Score">
                </div>
                <div class="form_control">
                    <label for="max_val">Max Score</label>
                    <input type="text" name="max_score" id="max_score" placeholder="Enter Max Score">
                </div>
                <div class="form_control">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Enter Your Result Title">
                </div>
                <div class="form_control">
                    <label for="desc">Description</label>
                    <textarea name="desc" id="desc" cols="10" rows="5" placeholder="Enter Your Description..."></textarea>
                </div>
                <div class="result_submit">
                    <button type="submit">Submit</button>
                    <a href="{{ route('category.create') }}">Create a Category?</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
