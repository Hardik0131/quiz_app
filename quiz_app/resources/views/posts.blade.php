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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/posts.css'])
    {{-- @vite(['resources/css/category.css']) --}}

</head>

<body>
    <div class="main">
        <div class="post_form">
            <div class="post_text">
                <h1>Create a Post</h1>
            </div>

            <div class="post_alert">
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
            <form action="{{ route('post.store') }}" method="POST" class="form" id="form" enctype="multipart/form-data">
                @csrf
                <div class="form_control">
                    <label for="post_name">Post Title</label>
                    <input type="text" name="post_name" id="post_name" placeholder="Enter your Post Title">
                </div>
                <div class="form_control">
                    <div class="select-wrapper">
                        <select name="category_id" id="select_category" required>
                            <option value="" id="default" disabled selected hidden>-- Select Category --</option>
                            @forelse ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @empty
                                <option value="" disabled>Not Record Found</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="form_control">
                    <input type="file" name="image" id="image"> 
                </div>
                <div class="form_control">
                    <label for="desc">Description</label>
                    <textarea name="desc" id="desc" cols="10" rows="5" placeholder="Description Here..."></textarea>
                </div>
                <div class="post_submit">
                    <button type="submit">Submit</button>
                    <a href="{{ route('question.create') }}">Create a Question?</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
