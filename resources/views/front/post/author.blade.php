@extends('front.layouts.app')
@section('title'){{ $author->getName() }} | @lang('transFront.app-name')@endsection
@section('keywords'){{ $author->getName() }}@endsection
@section('image'){{ asset('img/syyahat.jpg') }}@endsection
@section('content')
    <div class="container-lg py-3 py-sm-4">
        <div class="h4 border-bottom pb-2 pb-sm-3 mb-2 mb-sm-3">
            {{ $author->getName() }}
            <div class="small text-secondary mt-1 mt-sm-2">
                {{ $author->getJob() }}
            </div>
        </div>
        <div class="row">
            @forelse($posts as $post)
                <div class="col-md-6">
                    @include('front.app.post')
                </div>
            @empty
                <div class="col-12">
                    @component('front.app.not_found')
                        @lang('transAdmin.post')
                    @endcomponent
                </div>
            @endforelse
        </div>
        @if($posts->hasPages())
            <div class="pt-2 pt-sm-3" data-aos-once="true" data-aos="zoom-in-up">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection
