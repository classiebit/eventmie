@extends('eventmie::layouts.app')

@section('title')
    @lang('eventmie::em.my') @lang('eventmie::em.bookings')
@endsection

@section('content')

<main>
    <div class="lgx-post-wrapper">
        <section>
            <router-view></router-view>
        </section>
    </div>
</main>
         
@endsection


@section('javascript')

<script>    
    var path = {!! json_encode($path, JSON_HEX_TAG) !!};
</script>

<script type="text/javascript" src="{{ eventmie_asset('js/bookings_customer.js') }}"></script>
@stop