<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | @lang('transFront.app-website')</title>
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('front.layouts.meta')
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('css/front.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/aos.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/front.js') }}"></script>
    <link href="{{ asset('css/splide.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/splide-default.min.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/splide.min.js') }}"></script>
</head>
<body class="bg-light">
@include('front.app.alert')
@include('front.app.loading')
@include('front.app.scroll_to_top')
<div id="page-body">
    @include('front.app.nav')
    <div style="padding-top:4.2rem;" id="page-content">@yield('content')</div>
    <div id="page-push"></div>
</div>
<div id="page-footer">
    @include('front.app.footer')
</div>
<style>html, body {height: 100%;margin: 0;}  #page-body {min-height: 100%;}</style>
<script>
    AOS.init();
    function setFooter() {
        $('#page-body').css(
            {'margin-bottom': -$('#page-footer').height()}
        );
        $('#page-push').css(
            {'height': $('#page-footer').height()}
        );
    }
    $(document).ready(function () {
        AOS.refresh();
        setFooter();
        $(window).resize(function () {
            setFooter();
        })
    });
    $(window).on("load", function () {
        AOS.refresh();
        setFooter();
    });
</script>
</body>
</html>
