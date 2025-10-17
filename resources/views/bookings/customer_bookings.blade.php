@extends('eventmie::layouts.app')

@section('title')
    @lang('eventmie::em.mybookings')
@endsection

@section('content')
<main>
    <section class="bg-light">
        <router-view :is_success="{{ json_encode($is_success, JSON_HEX_APOS) }}"></router-view>
    </section>
</main>
@endsection


@section('javascript')
<script>
    var path = {!! json_encode($path, JSON_HEX_TAG) !!};
</script>
@vite(['vendor/classiebit/eventmie/resources/js/bookings_customer/index.js'])

@stop