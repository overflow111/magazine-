<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@lang('transFront.login')</title>
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome.solid.min.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</head>
<body class="bg-gradient-danger">
@include('admin.layouts.alert')
@include('admin.layouts.loading')
<div class="container">
    <div class="row vh-100 d-flex align-items-center justify-content-center">
        <div class="col-10 col-sm-6 col-md-5 col-lg-4">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-4 p-sm-5">
                    <img src="{{ asset('img/syyahat.svg') }}" alt="@lang('transFront.app-name')"
                         class="img-fluid mx-sm-3 mb-3 mb-sm-4">
                    <form method="POST" action="{{ route('admin.login') }}" id="form">
                        @csrf
                        <div class="form-group">
                            <input type="text" id="username"
                                   class="form-control{{ $errors->has('username') ? ' is-invalid':'' }}"
                                   value="{{ old('username') }}" name="username"
                                   placeholder="@lang('transFront.username')" required autofocus>
                            @if($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" id="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid':'' }}"
                                   name="password" placeholder="@lang('transFront.password')" required>
                            @if($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked':'' }}>
                                <label class="custom-control-label" for="remember">@lang('transFront.remember-me')</label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-danger btn-user btn-block" id="submit">
                                @lang('transFront.login')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#form").submit(function () {
        $("#submit").html("<i class='fas fa-spinner fa-pulse'></i>");
    });
</script>
</body>
</html>
