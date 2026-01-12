@extends('front.layout.master')

@section('vite')
    @vite(['resources/css/front/home.css'])
@endsection

@section('content')
    <section>
        <div class="post_container">
            <div class="trending">
                <div class="side_column_text">
                    <h2>Trending</h2>
                </div>
                @foreach ($posts as $index => $post)
                    <a href="{{ route('post.questions', [urlencode($post->category->name), urlencode($post->post_name)]) }}">
                        <div class="trending_post">
                            <div class="trending_post_image">
                                <img src="{{ asset('/images/category/' . $post->image) }}" alt="img">
                            </div>
                            <div class="trending_post_text">
                                <div class="trending_post_count">
                                    <h2>{{ $index + 1 }}</h2>
                                </div>
                                <div class="trending_post_category">
                                    <p>{{ $post->category->name }}</p>
                                    <h1>{{ $post->desc }}</h1>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="category_posts">
                <div class="category_post">
                    @foreach ($posts as $post)
                        <a
                            href="{{ route('post.questions', [urlencode($post->category->name), urlencode($post->post_name)]) }}">
                            <div class="post_card">
                                <div class="category_post_image">
                                    <img src="{{ asset('/images/category/' . $post->image) }}" alt="img">
                                </div>
                                <div class="post_text">
                                    <div class="post_category">
                                        {{ $post->category->name }}
                                    </div>
                                    <div class="category_post_text">
                                        <h1>{{ $post->desc }}</h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="most_tested">
                <div class="side_column_text">
                    <h2>Most Tested</h2>
                </div>
                <div class="tested_posts">
                    @foreach ($posts as $post)
                        <a
                            href="{{ route('post.questions', [urlencode($post->category->name), urlencode($post->post_name)]) }}">
                            <div class="most_tested_posts">
                                <div class="tested_post_image">
                                    <img src="{{ asset('/images/category/' . $post->image) }}" alt="img">
                                </div>
                                <div class="tested_post_text">
                                    <div class="tested_post_category">
                                        {{ $post->category->name }}
                                    </div>
                                    <div class="tested_post_desc">
                                        <h1>{{ $post->desc }}</h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    {{-- <section>
        <div class="post_container">
            @foreach ($posts as $post)
                <a href="{{ route('post.questions', [urlencode($post->category->name), urlencode($post->post_name)]) }}"
                    class="posts_count">
                    <div class="posts">
                        <img src="{{ asset('/images/category/' . $post->image) }}" alt="img">
                        <h1>{{ $post->desc }}</h1>
                    </div>
                    <div class="time">
                        <i class="ri-time-line"></i>
                        <h1>{{ $post->created_at->diffForHumans() }}</h1>
                    </div>
                </a>
            @endforeach
        </div>
    </section> --}}
@endsection
