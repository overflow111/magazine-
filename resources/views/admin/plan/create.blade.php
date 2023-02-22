@extends('admin.layouts.app')
@section('title') @lang('transAdmin.plans') @endsection
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="h4 mb-0">
            <a href="{{ route('admin.plans.index') }}">
                <i class="fas fa-caret-left"></i> @lang('transAdmin.plans')
            </a>
            <span class="text-gray-500">/</span>
            @lang('transAdmin.create')
        </div>
    </div>

    <div class="my-4">
        <form action="{{ route('admin.plans.store') }}">
            @csrf

            <div class="form-group row">
                <label for="name_tm" class="col-lg-4 col-md-4 col-form-label text-md-right">
                    <img src="{{ asset('img/flag/tkm.png') }}" alt="TKM" class="border">
                    @lang('transAdmin.name') <span class="text-danger">*</span>
                </label>
                <div class="col-lg-4 col-md-8">
                    <input id="name_tm" type="text"
                           class="form-control{{ $errors->has('name_tm') ? ' is-invalid' : '' }}" name="name_tm"
                           value="{{ old('name_tm') }}" required autofocus>
                    @if($errors->has('name_tm'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name_tm') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="name_ru" class="col-lg-4 col-md-4 col-form-label text-md-right">
                    <img src="{{ asset('img/flag/rus.png') }}" alt="RUS" class="border">
                    @lang('transAdmin.name')
                </label>
                <div class="col-lg-4 col-md-8">
                    <input id="name_ru" type="text"
                           class="form-control{{ $errors->has('name_ru') ? ' is-invalid' : '' }}" name="name_ru"
                           value="{{ old('name_ru') }}">
                    @if($errors->has('name_ru'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name_ru') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="name_en" class="col-lg-4 col-md-4 col-form-label text-md-right">
                    <img src="{{ asset('img/flag/eng.png') }}" alt="ENG" class="border">
                    @lang('transAdmin.name')
                </label>
                <div class="col-lg-4 col-md-8">
                    <input id="name_en" type="text"
                           class="form-control{{ $errors->has('name_en') ? ' is-invalid' : '' }}" name="name_en"
                           value="{{ old('name_en') }}">
                    @if($errors->has('name_en'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name_en') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="month" class="col-lg-4 col-md-4 col-form-label text-md-right">
                    @lang('transAdmin.month') <span class="text-danger">*</span>
                </label>
                <div class="col-lg-4 col-md-8">
                    <input id="month" type="number" min="1" max="36"
                           class="form-control{{ $errors->has('month') ? ' is-invalid' : '' }}"
                           name="month" value="1" required>
                    @if($errors->has('month'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('month') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="download" class="col-lg-4 col-md-4 col-form-label text-md-right">
                    @lang('transAdmin.magazine') <span class="text-danger">*</span>
                </label>
                <div class="col-lg-4 col-md-8">
                    <input id="download" type="number" min="1" max="36"
                           class="form-control{{ $errors->has('download') ? ' is-invalid' : '' }}"
                           name="download" value="1" required>
                    @if($errors->has('download'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('download') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-lg-4 col-md-4 col-form-label text-md-right">
                    @lang('transAdmin.price') <span class="text-danger">*</span>
                </label>
                <div class="col-lg-4 col-md-8">
                    <input id="price" type="number" min="1" step="0.1"
                           class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                           name="price" value="1" required>
                    @if($errors->has('price'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4 offset-lg-4 col-md-8 offset-md-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="active" name="active"
                               value="1">
                        <label class="custom-control-label" for="active">
                            @lang('transAdmin.enable')
                        </label>
                    </div>
                </div>
            </div>

            {{--submit button--}}
            <div class="form-group row mb-0">
                <div class="col-lg-4 offset-lg-4 col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-save"></i> @lang('transAdmin.save')
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection