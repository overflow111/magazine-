@extends('front.layouts.app')
@section('title')@lang('transAdmin.magazines') | @lang('transFront.app-name')@endsection
@section('keywords')@lang('transAdmin.magazines')@endsection
@section('image'){{ asset('img/syyahat.jpg') }}@endsection
@section('content')
    <div class="container-lg py-3 py-sm-4">
        <div class="h4 border-bottom pb-2 pb-sm-3 mb-2 mb-sm-3">
            @lang('transAdmin.magazines')
        </div>
        <div class="row">
            @forelse($magazines as $magazine)
                <div class="col-md-6">
                    @include('front.app.magazine')
                </div>
            @empty
                <div class="col-12">
                    @component('front.app.not_found')
                        @lang('transAdmin.magazine')
                    @endcomponent
                </div>
            @endforelse
        </div>
        @if($magazines->hasPages())
            <div class="pt-2 pt-sm-3" data-aos-once="true" data-aos="zoom-in-up">
                {{ $magazines->links() }}
            </div>
        @endif
    </div>
@endsection
