@extends('eventmie::layouts.app')

{{-- Page title --}}
@section('title')
    @if(empty($event)) 
        @lang('eventmie::em.create') @lang('eventmie::em.event')
    @else
        @lang('eventmie::em.update') @lang('eventmie::em.event')
    @endif
@endsection

    
@section('content')

<main>
    
    <div class="lgx-post-wrapper">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="lgx-tab">
                            <tabs-component :event_id="{{ !empty($event) ? $event->id : 0 }}"></tabs-component>
                            
                            <div class="tab-content lgx-tab-content lgx-tab-content-event">
                                <router-view :is_admin="{{ json_encode(Auth::user()->hasRole('admin'))}}"></router-view>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
</main>

@endsection

@section('javascript')
<script type="text/javascript" src="{{ eventmie_asset('js/events_manage.js') }}"></script>

@stop
