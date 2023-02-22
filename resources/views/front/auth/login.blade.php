@extends('front.layouts.app')
@section('title')@lang('transFront.login') | @lang('transFront.app-name')@endsection
@section('keywords')@lang('transFront.login')@endsection
@section('image'){{ asset('img/syyahat.jpg') }}@endsection
@section('content')
    <div class="container-lg py-3 py-sm-4">
        <div class="h4 text-center border-bottom pb-2 pb-sm-3 mb-2 mb-sm-3">
            @lang('transFront.login')
        </div>
        <form action="{{ route('login') }}" method="post" class="py-4 py-sm-5">
            @csrf
            @honeypot
            <div class="form-row justify-content-center">
                <div class="col-10 col-sm-8 col-md-6 col-lg-4">
                    @if(!$customer)
                        <div class="form-group mb-3">
                            <label for="name" class="font-weight-bold">@lang('transFront.u-name') <span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid':'' }}"
                                   name="name" value="{{ old('name') }}" maxlength="150" required {{ !$customer ? 'autofocus':'' }}>
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="surname" class="font-weight-bold">@lang('transFront.surname') <span class="text-danger">*</span></label>
                            <input id="surname" type="text" class="form-control {{ $errors->has('surname') ? ' is-invalid':'' }}"
                                   name="surname" value="{{ old('surname') }}" maxlength="150" required>
                            @if($errors->has('surname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('surname') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="font-weight-bold">@lang('transFront.e-mail') <span class="text-danger">*</span></label>
                            <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid':'' }}"
                                   name="email" value="{{ old('email') }}" maxlength="150" required>
                            @if($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    @endif
                    <div class="form-group mb-3">
                        <label for="phone" class="font-weight-bold">@lang('transFront.phone') <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+993</span>
                            </div>
                            <input id="phone" type="number" min="60000000" max="65999999" class="form-control {{ $errors->has('phone') ? ' is-invalid':'' }}"
                                   name="phone" value="{{ $phone }}" required readonly>
                        </div>
                        @if($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="code" class="font-weight-bold">@lang('transFront.code') <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                            </div>
                            <input id="code" type="number" min="10000" max="99999" class="form-control {{ $errors->has('code') ? ' is-invalid':'' }}"
                                   name="code" value="{{ old('code') }}" required {{ !$customer ? '':'autofocus' }}>
                        </div>
                        @if($errors->has('code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('code') }}</strong>
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
