@extends('admin.layouts.app')
@section('title') @lang('transAdmin.customers') @endsection
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="h4 mb-0">
            <a href="{{ route('admin.customers.index') }}">
                <i class="fas fa-caret-left"></i> @lang('transAdmin.customers')
            </a>
            <span class="text-gray-500">/</span>
            @lang('transAdmin.edit')
        </div>
    </div>

    <div class="my-4">
        <form action="{{ route('admin.customers.update', $obj->id) }}" method="post">
            {{ method_field('PUT') }}
            @csrf

            <div class="form-group row">
                <label for="name" class="col-lg-4 col-md-4 col-form-label text-md-right">
                    @lang('transAdmin.name') <span class="text-danger">*</span>
                </label>
                <div class="col-lg-4 col-md-8">
                    <input id="name" type="text"
                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                           value="{{ $obj->name }}" required autofocus>
                    @if($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="surname" class="col-lg-4 col-md-4 col-form-label text-md-right">
                    @lang('transAdmin.surname') <span class="text-danger">*</span>
                </label>
                <div class="col-lg-4 col-md-8">
                    <input id="surname" type="text"
                           class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname"
                           value="{{ $obj->surname }}" required>
                    @if($errors->has('surname'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('surname') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-lg-4 col-md-4 col-form-label text-md-right">
                    @lang('transAdmin.email') <span class="text-danger">*</span>
                </label>
                <div class="col-lg-4 col-md-8">
                    <input id="email" type="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                           value="{{ $obj->email }}" required>
                    @if($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="username" class="col-lg-4 col-md-4 col-form-label text-md-right">
                    @lang('transAdmin.username') <span class="text-danger">*</span>
                </label>
                <div class="col-lg-4 col-md-8">
                    <input id="username" type="number" min="60000000" max="65999999"
                           class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username"
                           value="{{ $obj->username }}" required>
                    @if($errors->has('username'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
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