@extends('eventmie::layouts.app')

{{-- Page title --}}
@section('title')
    @lang('eventmie::em.events')
@endsection

@section('content')
<main>
    <div class="lgx-page-wrapper">
        <router-view></router-view>
    </div>
</main>
@endsection

@section('javascript')

<script>    
    var path = {!! json_encode($path, JSON_HEX_TAG) !!};
</script>

<script type="text/javascript" src="{{ eventmie_asset('js/events_listing.js') }}"></script>
@stop