@extends('front.layouts.app')
@section('title'){{ $post->getTitle() }} | @lang('transFront.app-name')@endsection
@section('keywords'){{ $post->getTitle() }}@endsection
@section('image')@if($post->image){{ Request::root() }}{{ Storage::disk('local')->url($post->image) }}@else{{ asset('img/syyahat.jpg') }}@endif
@endsection
@section('content')
    <div class="container-lg py-3 py-sm-4">
        <div class="row">
            <div class="col-md-8 py-2 py-sm-3">
                <div class="mb-2 mb-sm-3">
                    @if($post->image)
                        @if($post->images->count() > 1)
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    new Splide('.images-splide', {
                                        autoplay: true,
                                        interval: 7500,
                                    }).mount();
                                });
                            </script>
                            <link href="{{ asset('css/jquery.fancybox.min.css') }}" rel="stylesheet">
                            <script type="text/javascript" src="{{ asset('js/jquery.fancybox.min.js') }}" defer></script>
                            <div class="splide images-splide w-100">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        @foreach($post->images as $image)
                                            <li class="splide__slide">
                                                <a data-fancybox="post" title="{{ $post->getTitle() }}"
                                                   data-caption="{{ $post->getTitle() }}"
                                                   href="{{ Storage::disk('local')->url($image->image) }}">
                                                    <img src="{{ asset('img/temp/post.png') }}"
                                                         data-src="{{ Storage::disk('local')->url($image->image) }}"
                                                         alt="{{ $post->getTitle() }}"
                                                         class="load-image img-fluid rounded">
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @else
                            <link href="{{ asset('css/jquery.fancybox.min.css') }}" rel="stylesheet">
                            <script type="text/javascript" src="{{ asset('js/jquery.fancybox.min.js') }}" defer></script>
                            @foreach($post->images as $image)
                                <a data-fancybox="post" title="{{ $post->getTitle() }}"
                                   data-caption="{{ $post->getTitle() }}"
                                   href="{{ Storage::disk('local')->url($image->image) }}">
                                    <img src="{{ asset('img/temp/post.png') }}"
                                         data-src="{{ Storage::disk('local')->url($image->image) }}"
                                         alt="{{ $post->getTitle() }}"
                                         class="load-image img-fluid rounded">
                                </a>
                            @endforeach
                        @endif
                    @else
                        <img src="{{ asset('img/temp/post.png') }}"
                             alt="{{ $post->getTitle() }}"
                             class="img-fluid rounded">
                    @endif
                </div>
                <div class="bg-white border rounded p-3 p-sm-4">
                    <a href="{{ route('category', $post->category->slug) }}" title="{{ $post->category->getName() }}"
                       class="d-block text-success font-weight-bold small text-uppercase mb-sm-1">
                        {{ $post->category->getName() }}
                    </a>
                    <a href="{{ route('post', $post->slug) }}" title="{{ $post->getTitle() }}"
                       class="d-block h6 mb-2">
                        {{ $post->getTitle() }}
                    </a>
                    <a href="{{ route('author', $post->author->slug) }}" title="{{ $post->author->getName() }}"
                       class="d-block h6 text-secondary mb-1">
                        {{ $post->author->getName() }}
                    </a>
                    <div class="small text-secondary mb-1 mb-sm-2">
                        {{ $post->author->getJob() }}
                    </div>
                    <div class="small text-secondary mb-2 mb-sm-3">
                        {{ $post->published_at->format('d.m.Y') }}
                    </div>
                    <div>
                        {!! $post->getBody() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @foreach($categoryPosts as $post)
                    @include('front.app.post')
                @endforeach
                @foreach($authorPosts as $post)
                    @include('front.app.post')
                @endforeach
            </div>
        </div>
    </div>
@endsection
