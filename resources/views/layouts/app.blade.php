<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    @include('eventmie::layouts.meta')

    @include('eventmie::layouts.favicon')

    @include('eventmie::layouts.include_css')
</head>

<body class="home" {!! is_rtl() ? 'dir="rtl"' : '' !!}>

    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
        your browser</a> to improve your experience.</p>
    <![endif]-->

    {{-- Ziggy directive --}}
    @routes

    {{-- Main wrapper --}}
    <div class="lgx-container">
    
        @include('eventmie::layouts.header')

        @php 
            $no_breadcrumb = [
                'eventmie.welcome', 
                'eventmie.events_show',
                'eventmie.login', 
                'eventmie.register', 
                'eventmie.register_show', 
                'eventmie.password.request', 
                'eventmie.password.reset',
            ]    
        @endphp
        @if (!in_array(Route::currentRouteName(), $no_breadcrumb))
            @include('eventmie::layouts.breadcrumb')
        @endif

        <section class="main-wrapper" id="eventmie_app">
        
            {{-- page content --}}
            @yield('content')

            {{-- set progress bar --}}
            <vue-progress-bar></vue-progress-bar>
        </section>

        @include('eventmie::layouts.footer')

    </div>
    <!--Main wrapper end-->

    @include('eventmie::layouts.include_js')
    
    {{-- Page specific javascript --}}
    @yield('javascript')

</body>
</html>
