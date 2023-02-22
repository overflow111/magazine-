@extends('front.layouts.app')
@section('title')@lang('transFront.about-us') | @lang('transFront.app-name')@endsection
@section('keywords')@lang('transFront.about-us')@endsection
@section('image'){{ asset('img/syyahat.jpg') }}@endsection
@section('content')
    <div class="container-lg py-3 py-sm-4">
        <div class="h4 border-bottom pb-2 pb-sm-3 mb-2 mb-sm-3">
            @lang('transFront.about-us')
        </div>
        <div class="py-2 py-sm-3">
            {!! $page->getBody() !!}
        </div>
    </div>
@endsection
