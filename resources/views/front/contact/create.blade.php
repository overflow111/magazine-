@extends('front.layouts.app')
@section('title')@lang('transFront.contact-to-administrator') | @lang('transFront.app-name')@endsection
@section('keywords')@lang('transFront.contact-to-administrator')@endsection
@section('image'){{ asset('img/syyahat.jpg') }}@endsection
@section('content')
    <div class="container-lg py-3 py-sm-4">
        <div class="h4 text-center border-bottom pb-2 pb-sm-3 mb-2 mb-sm-3">
            @lang('transFront.contact-to-administrator')
        </div>
        <form action="{{ route('contact') }}" method="post" class="py-4 py-sm-5">
            @csrf
            @honeypot
            <div class="form-row justify-content-center">
                <div class="col-sm-8 col-md-6 col-lg-4">
                    <div class="form-group mb-3">
                        <label for="name" class="font-weight-bold">
                            @lang('transFront.u-name') <span class="text-danger">*</span>
                        </label>
                        <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid':'' }}"
                               name="name" value="{{ old('name') }}" maxlength="150" required autofocus>
                        @if($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone_or_email" class="font-weight-bold">
                            @lang('transFront.phone-or-email') <span class="text-danger">*</span>
                        </label>
                        <input id="phone_or_email" type="text" class="form-control {{ $errors->has('phone_or_email') ? ' is-invalid':'' }}"
                               name="phone_or_email" value="{{ old('phone_or_email') }}" maxlength="150" required>
                        @if($errors->has('phone_or_email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone_or_email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="message" class="font-weight-bold">
                            @lang('transFront.message') <span class="text-danger">*</span>
                        </label>
                        <textarea id="message" name="message" class="form-control {{ $errors->has('message') ? ' is-invalid':'' }}"
                                  rows="5" maxlength="500" required>{{ old('message') }}</textarea>
                        @if($errors->has('message'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('message') }}</strong>
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-danger btn-block">
                        @lang('transFront.submit') <i class="bi bi-envelope text-lg"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
