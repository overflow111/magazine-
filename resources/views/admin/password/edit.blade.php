@extends('admin.layouts.app')
@section('title') @lang('transAdmin.password') @endsection
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="h3 mb-0">@lang('transAdmin.password')</div>
    </div>

    <div class="my-4">
        <form action="{{ route('admin.password.update') }}" method="post">
            @csrf

            <div class="form-group row">
                <label for="current_password" class="col-lg-4 col-md-4 col-form-label text-md-right">
                    @lang('transAdmin.current-password') <span class="text-danger">*</span>
                </label>
                <div class="col-lg-4 col-md-8">
                    <input id="current_password" type="password"
                           class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}"
                           name="current_password" required autofocus>
                    @if($errors->has('current_password'))
                        <span class="invalid-feedback help-block" role="alert">
                            <strong>{{ $errors->first('current_password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="new_password" class="col-lg-4 col-md-4 col-form-label text-md-right">
                    @lang('transAdmin.new-password') <span class="text-danger">*</span>
                </label>
                <div class="col-lg-4 col-md-8">
                    <input id="new_password" type="password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="new_password"
                           required>
                    @if($errors->has('new_password'))
                        <span class="invalid-feedback help-block" role="alert">
                        <strong>{{ $errors->first('new_password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>


            <div class="form-group row">
                <label for="new_password_confirm" class="col-lg-4 col-md-4 control-label text-md-right">
                    @lang('transAdmin.new-password-confirm') <span class="text-danger">*</span>
                </label>
                <div class="col-lg-4 col-md-8">
                    <input id="new_password_confirm" type="password" class="form-control"
                           name="new_password_confirmation" required>
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