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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/category.css'])
    {{-- @vite(['resources/css/category.css']) --}}

</head>

<body>
    <div class="main">
        <div class="category_form">
            <div class="category_text">
                <h1>Create a Category</h1>
            </div>

            <div class="category_alert">
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
            <form action="{{ route('category.store') }}" method="POST" class="form" id="form">
                @csrf
                <div class="form_control">
                    <label for="name">Category Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter your Category Name">
                </div>
                <div class="form_control">
                    <label for="short_desc">Short Description</label>
                    <input type="text" name="short_desc" id="short_desc" placeholder="Short Description Here...">
                </div>
                <div class="form_control">
                    <label for="long_desc">Long Description</label>
                    <textarea name="long_desc" id="long_desc" cols="10" rows="5" placeholder="Long Description Here..."></textarea>
                </div>
                <div class="category_submit">
                    <button type="submit">Submit</button>
                    <a href="{{ route('post.create') }}">Create a Post?</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
