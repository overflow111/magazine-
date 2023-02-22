@extends('front.layouts.app')
@section('title')@lang('transFront.login') | @lang('transFront.app-name')@endsection
@section('keywords')@lang('transFront.login')@endsection
@section('image'){{ asset('img/syyahat.jpg') }}@endsection
@section('content')
    <div class="container-lg py-3 py-sm-4">
        <div class="h4 text-center border-bottom pb-2 pb-sm-3 mb-2 mb-sm-3">
            @lang('transFront.login')
        </div>
        <form action="{{ route('verification') }}" method="post" class="py-4 py-sm-5">
            @csrf
            @honeypot
            <div class="form-row justify-content-center">
                <div class="col-10 col-sm-8 col-md-6 col-lg-4">
                    <div class="form-group mb-3">
                        <label for="phone" class="font-weight-bold">@lang('transFront.phone') <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+993</span>
                            </div>
                            <input id="phone" type="number" min="60000000" max="65999999" class="form-control {{ $errors->has('phone') ? ' is-invalid':'' }}"
                                   name="phone" value="{{ old('phone') }}" required autofocus>
                        </div>
                        @if($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-danger btn-block">
                        @lang('transFront.login') <i class="bi bi-box-arrow-in-right text-lg"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
