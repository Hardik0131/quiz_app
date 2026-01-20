<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nothing</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.8.0/fonts/remixicon.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/nav.js', 'resources/css/layout/nav.css', 'resources/css/category.css', 'resources/css/layout/footer.css'])
    @yield('vite')
</head>

<body>
    <header>
        <nav>
            <div class="web_logo">
                <a href="#">
                    <img src="{{ asset('images/app2_logo.png') }}" alt="">
                </a>
            </div>
            <div class="category_nav">
                <ul>
                    <li>
                        <a href="{{ route('category.index') }}">Recents All</a>
                    </li>
                    @forelse ($categorys as $cat)
                        <li>
                            <a href="{{ route('category.post', $cat->name) }}">{{ $cat->name }}</a>
                        </li>
                    @empty
                        <li>
                            <a href="#">No Record Found</a>
                        </li>
                    @endforelse
                </ul>
            </div>
            <div class="nav_item">
                <ul class="nav_menu">
                    <i class="ri-facebook-circle-line"></i>
                    <i class="ri-whatsapp-line"></i>
                    <i class="ri-instagram-line"></i>
                </ul>
                <ul class="nav_menu_icon">
                    <li><i class="ri-menu-3-line"></i></li>
                </ul>
            </div>
        </nav>
        <div class="sidebar">
            <ul>
                <li>
                    <a href="{{ route('category.index') }}">Recents All</a>
                </li>
                @forelse ($categorys as $cat)
                    <li>
                        <a href="{{ route('category.post', $cat->name) }}">{{ $cat->name }}</a>
                    </li>
                @empty
                    <li>
                        <a href="#">No Record Found</a>
                    </li>
                @endforelse
            </ul>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    @include('front.layout.footer')
</body>

</html>
