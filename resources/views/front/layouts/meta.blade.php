    <!-- SEO -->
    <meta name="author" content="@lang('transFront.app-name')"/>
    <meta name="description" content="@lang('transFront.description')">
    <link rel="canonical" href="{{ URL::current() }}">
    <meta name="keywords" content="@lang('transFront.app-name'), @yield('keywords'), @lang('transFront.keywords')">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#be2617">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#be2617">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#be2617">
    <!-- Social:Twitter -->
    <meta name="twitter:title" content="@lang('transFront.app-name')">
    <meta name="twitter:description" content="@lang('transFront.description')">
    <meta name="twitter:image:src" content="@yield('image')">
    <!-- Social:Facebook / Open Graph -->
    <meta property="og:url" content="{{ URL::current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@lang('transFront.app-name')">
    <meta property="og:image" content="@yield('image')"/>
    <meta property="og:description" content="@lang('transFront.description')">
    <meta property="og:site_name" content="@lang('transFront.app-name')">
    <!-- Social:Google+ / Schema.org  -->
    <meta itemprop="name" content="@lang('transFront.app-name')">
    <meta itemprop="description" content="@lang('transFront.description')">
    <meta itemprop="image" content="@yield('image')">