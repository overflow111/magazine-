@extends('front.layouts.app')
@section('title')@lang('transFront.app-name')@endsection
@section('keywords')@lang('transFront.home')@endsection
@section('image'){{ asset('img/syyahat.jpg') }}@endsection
@section('content')
    @include('front.home.index.recommended')
    @if($mainPosts->count())
        @include('front.home.index.main')
    @endif
    <div class="container-lg py-3 py-sm-4">
        @include('front.app.menu')
    </div>
    @if($advicePosts->count())
        @include('front.home.index.advice')
    @endif
@endsection
