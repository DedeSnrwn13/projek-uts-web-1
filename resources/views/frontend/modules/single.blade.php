@extends('frontend.layouts.master')

@section('title', 'Welcome')

@section('banner')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>{{ __('Post Details') }}</h4>
                            <h2>{{ __('Single blog post') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="blog-post">
            <div class="blog-thumb">
                <img src="{{ $post->photo }}" alt="{{ $post->title }}">
            </div>
            <div class="down-content">
                <span>{{ $post->category?->name }}</span>
                <a href="{{ route('front.single', $post->slug) }}">
                    <h4>{{ $post->title }}</h4>
                </a>
                <ul class="post-info">
                    <li><a href="#">{{ $post->user?->name }}</a></li>
                    <li><a href="#">{{ $post->created_at->format('M d, Y') }}</a></li>
                    <li><a href="#">{{ $post->comment->count() }} {{ __('Comments') }}</a></li>
                    <li><a href="#">{{ $post->post_read_count?->count }} {{ __('Read') }}</a></li>
                </ul>
                <div class="post-description">
                    <p>{!! $post->description !!}</p>
                </div>
                <div class="post-options">
                    <div class="row">
                        <div class="col-6">
                            <ul class="post-tags">
                                <li><i class="fa fa-tags"></i></li>
                                @foreach ($post->tag as $tag)
                                    <li><a href="{{ route('front.tag', $tag->slug) }}">{{ $tag->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="post-share">
                                <li><i class="fa fa-share-alt"></i></li>
                                <li><a href="#">Facebook</a>,</li>
                                <li><a href="#"> Twitter</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="sidebar-item comments">
            <div class="sidebar-heading">
                <h2>{{ $post->comment->count() }} {{ __('comments') }}</h2>
            </div>
            <div class="content">
                <ul>
                    @foreach ($post->comment as $comment)
                        <li>
                            <div class="author-thumb">
                                <img src="{{ asset('frontend/assets/images/comment-author-01.jpg') }}" alt="">
                            </div>
                            <div class="right-content">
                                <h4>{{ $comment->user?->name }}<span>{{ $comment->created_at->format('M d, Y') }}</span></h4>
                                <p>{{ $comment->comment }}</p>
                                <h6>{{ __('Write Reply') }}</h6>
                                {!! Form::open(['method'=>'post', 'route'=>'comment.store']) !!}
                                {!! Form::hidden('post_id', $post->id) !!}
                                {!! Form::hidden('comment_id', $comment->id) !!}
                                {!! Form::text('comment', null, ['class'=>'form-control form-control-sm mt-2', 'placeholder'=>'Write your reply']) !!}
                                {!! Form::button('Reply', ['class'=>'btn btn-outline-success btn-sm mt-2', 'type'=>'submit']) !!}
                                {!! Form::close() !!}
                            </div>
                        </li>
                        @foreach ($comment->reply as $reply)
                            <li class="replied">
                                <div class="author-thumb">
                                    <img src="{{ asset('frontend/assets/images/comment-author-02.jpg') }}" alt="">
                                </div>
                                <div class="right-content">
                                    <h4>{{ $reply->user?->name }}<span>{{ $reply->created_at->format('M d, Y') }}</span></h4>
                                    <p>{{ $reply->comment }}</p>
                                </div>
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="sidebar-item submit-comment">
            <div class="sidebar-heading">
                <h2>{{ __('Your comment') }}</h2>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ route('comment.store') }}" method="POST">
                            @csrf

                            <input type="hidden" value="{{ $post->id }}" name="post_id">
                            <textarea class="form-control border" name="comment" rows="6" placeholder="{{ __('Type your comment') }}" required="required"></textarea>
                            <button type="submit" class="main-button">{{ __('Submit') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            const readCount = () => {
                axios.get(window.location.origin + '/post-count/' + {{ $post->id }})
            }

            setTimeout(() => {
                readCount();
            }, 10000);
        </script>
    @endpush

    @if (session('msg'))
        @php
            $cls = session('cls') == 'danger' ? 'error' : session('cls');
        @endphp

        @push('js')
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "{{ $cls }}",
                    toast: true,
                    title: "{{ session('msg') }}",
                    showConfirmButton: false,
                    timer: 3000
                });
            </script>
        @endpush
    @endif
@endsection
