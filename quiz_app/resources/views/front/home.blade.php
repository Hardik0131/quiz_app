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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/front/home.css'])
    {{-- @vite(['resources/css/category.css']) --}}
</head>

<body>
    <header>
        <nav>
            <div class="sub-nav-bar">
                <ul>
                    <li>
                        <a href="{{ route('category.index') }}">Recents All</a>
                    </li>
                    @forelse ($categories as $category)
                        <li>
                            <a href="{{ route('category.post', $category->name) }}">{{ $category->name }}</a>
                        </li>
                    @empty
                        <li>
                            <a href="#">No Record Found</a>
                        </li>
                    @endforelse
                </ul>
            </div>
        </nav>
    </header>
    <section>
        <div class="post_container">
            @foreach ($posts as $post)
                <a href="{{ route('post.questions', [urlencode($post->category->name), urlencode($post->post_name)]) }}" class="posts_count">
                    <div class="posts">
                        <img src="{{ asset('/images/category/'.$post->image) }}" alt="img">
                        <h1>{{ $post->desc }}</h1>
                    </div>
                    <div class="time">
                        <i class="ri-time-line"></i>
                        <h1>{{ $post->created_at->diffForHumans() }}</h1>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
</body>

</html>
