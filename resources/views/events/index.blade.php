@extends('eventmie::layouts.app')

{{-- Page title --}}
@section('title')
    @lang('eventmie::em.events')
@endsection

@section('content')

    <main>
        <router-view
            :date_format="{{ json_encode(
                [
                    'vue_date_format' => format_js_date(),
                    'vue_time_format' => format_js_time(),
                ],
                JSON_HEX_APOS,
            ) }}">
        </router-view>

    </main>
@endsection

@section('javascript')
    <script>
        var path = {!! json_encode($path, JSON_HEX_TAG) !!};
        var events_slider = false;
    </script>
    @vite(['vendor/classiebit/eventmie/resources/js/events_listing/index.js'])


@stop
