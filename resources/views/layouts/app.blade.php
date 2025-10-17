<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}" {!! is_rtl() ? 'dir="rtl"' : '' !!}>

<head>

    @include('eventmie::layouts.meta')

    @include('eventmie::layouts.favicon')

    @include('eventmie::layouts.include_css')
    
    {!! CookieConsent::styles() !!}

    @yield('stylesheet')
</head>

<body class="home @if(str_contains(request()->url(), 'dashboard')) dashboard-body-bg @else bg-white @endif" {!! is_rtl() ? 'dir="rtl"' : '' !!}>

    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
        your browser</a> to improve your experience.</p>
    <![endif]-->

    {{-- Ziggy directive --}}
    @routes

    {{-- Main wrapper --}}
    <div id="eventmie_app">

        @include('eventmie::layouts.header')

        @php
            $no_breadcrumb = [
                'eventmie.welcome',
                'eventmie.events_index',
                'eventmie.events_show',
                'eventmie.login',
                'eventmie.register',
                'eventmie.register_show',
                'eventmie.password.request',
                'eventmie.password.reset',
                'eventmie.myevents_index',
                'eventmie.myevents_form',
                'eventmie.profile',
            ];
        @endphp
        @if (!in_array(Route::currentRouteName(), $no_breadcrumb))
            @include('eventmie::layouts.breadcrumb')
        @endif

        <section class="db-wrapper">

            {{-- page content --}}
            @yield('content')

            {{-- set progress bar --}}
            <vue-progress-bar></vue-progress-bar>
        </section>

        @if(!str_contains(request()->url(), 'dashboard'))
            @include('eventmie::layouts.footer')
        @endif

    </div>
    <!--Main wrapper end-->

    @include('eventmie::layouts.include_js')

    {!! CookieConsent::scripts() !!}

    {{-- Page specific javascript --}}
    @yield('javascript')
    @stack('scriptsDashboard')

</body>

</html>
