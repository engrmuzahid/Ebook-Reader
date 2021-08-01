<!DOCTYPE html>
<html lang="{{ locale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
            @hasSection('title')
                @yield('title') - {{ setting('site_name') }}
            @else
                {{ setting('site_name') }}
            @endif
        </title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        @stack('meta')

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600|Rubik:400,500" rel="stylesheet">

        @if (is_rtl())
            <link rel="stylesheet" href="{{ v(Theme::url('public/css/app.rtl.css')) }}">
        @else
            <link rel="stylesheet" href="{{ v(Theme::url('public/css/app.css')) }}">
        @endif

        <link rel="shortcut icon" href="{{ $favicon }}" type="image/x-icon">

        @stack('styles')

        @if(setting('custom_css')!='')
            <style>
                {!! setting('custom_css') !!}
            </style>
        @endif

        <script>
            window.CynoEBook = {
                csrfToken: '{{ csrf_token() }}',
                langs: {
                    'cynoebook::ebooks.loading': '{{ clean(trans("cynoebook::ebooks.loading")) }}',
                },
            };
        </script>

        @stack('globals')
        
        {!! setting('googleanalyticscode',null,0) !!}
        
        @routes
    </head>

    <body class="{{ $theme }} {{ cynoebook_layout() }} {{ is_rtl() ? 'rtl' : 'ltr' }}">
        <!--[if lt IE 8]>
            <p>You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="main" id="app">
            <div class="wrapper">
                @include('public.include.sidebar')
                @include('public.include.top_nav')
                @include('public.include.header')
                @include('public.include.navbar')

                <div class="content-wrapper clearfix">
                    <div class="container">
                        @include('public.include.breadcrumb')

                        @unless (request()->routeIs('home') || request()->routeIs('login') || request()->routeIs('register') || request()->routeIs('reset') || request()->routeIs('reset.complete'))
                            @include('public.include.notification')
                        @endunless

                        @yield('content')
                    </div>
                </div>
                @include('public.include.subscribe')
                @include('public.include.footer')

                <a class="scroll-top" href="#">
                    <i class="fa fa-angle-up" aria-hidden="true"></i>
                </a>
            </div>
            
            @include('public.include.cookie_bar')
            @include('public.include.newsletter')
            
        </div>

        <script src="{{ v(Theme::url('public/js/app.js')) }}"></script>

        @stack('scripts')

        @if(setting('custom_js',null,0)!='')
        <script>
            {!! setting('custom_js',null,0) !!}
        </script>
        @endif
    </body>
</html>
