<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-danger text-light text-right">
<div class="container">
    <div class="row vh-100 d-flex align-items-center justify-content-center">
        <div class="col-lg-4 col-md-6 col-sm-8 col-10 py-5">
            <div class="display-1">
                @yield('code')
            </div>
            <div class="display-4">
                @yield('message')
            </div>
        </div>
    </div>
</div>
</body>
</html>
