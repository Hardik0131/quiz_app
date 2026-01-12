<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin/sidebar.js', 'resources/css/admin/layout/sidebar.css', 'resources/js/admin/master.js', 'resources/css/admin/layout/master.css', 'resources/css/admin/category.css', 'resources/js/admin/category.js'])
</head>

<body>
    @include('admin.layout.sidebar')
    <section class="home-section">
        <div class="admin-nav">
            <div class="profile-icon">
                <i class="bx bx-user main"></i>
            </div>
            <ul class="profile-detail">
                <li>
                    <a href="#">
                        <i class="bx bxs-user user"></i>
                        <span class="">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bx bx-log-out"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <main class="main-content">
            {!! $content ?? '' !!}
        </main>
    </section>
</body>

</html>