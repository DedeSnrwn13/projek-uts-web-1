@extends('frontend.layouts.master')

@section('title', $title)

@section('banner')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>{{ $title }}</h4>
                            <h2>{{ $sub_title }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('content')
    @foreach ($posts as $post)
        <div class="col-lg-12">
            <div class="blog-post">
                <div class="blog-thumb">
                    <img src="{{ $post->photo }}" alt="{{ $post->title }}">
                </div>
                <div class="down-content">
                    <span>{{ $post->category?->name }} <sub class="text-warning"><small>{{ $post->sub_category?->name }}</small></sub></span>
                    <a href="{{ route('front.single', $post->slug) }}">
                        <h4>{{ $post->title }}</h4>
                    </a>
                    <ul class="post-info">
                        <li><a href="#">{{ $post->user->name }}</a></li>
                        <li><a href="#">{{ $post->created_at->format('M d, Y') }}</a></li>
                        <li><a href="#">{{ $post->comment->count() }} {{ __('Comments') }}</a></li>
                    </ul>
                    <p>
                        {{ strip_tags(substr($post->description, 0, 700)) . '...' }}
                        <a href="{{ route('front.single', $post->slug) }}">
                            <button class="read-more-button">{{ __('Read More') }}</button>
                        </a>
                    </p>
                    <div class="post-options">
                        <div class="row">
                            <div class="col-6">
                                <ul class="post-tags">
                                    <li><i class="fa-solid fa-tags"></i></li>
                                    @foreach ($post->tag as $tag)
                                        <li><a href="{{ route('front.tag', $tag->slug) }}">{{ $tag->name }}</a>,</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="post-share">
                                    <li><i class="fa-solid fa-share-alt"></i></li>
                                    <li><a href="#">Facebook</a>,</li>
                                    <li><a href="#"> Twitter</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @if (count($posts) < 1)
        <h3 class="text-center text-danger">{{ __('No Post Found') }}</h3>
    @endif

    <div class="col-lg-12">
        {{ $posts->links() }}
    </div>
@endsection
