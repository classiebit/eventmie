@extends('eventmie::layouts.app')

@section('title', $event->title)
@section('meta_title', $event->meta_title)
@section('meta_keywords', $event->meta_keywords)
@section('meta_description', $event->meta_description)
@section('meta_image', '/storage/'.$event['poster'])
@section('meta_url', url()->current())

    
@section('content')

<!--BANNER-->
<section>
    <div class="lgx-banner event-poster" style="background-image: url({{ '/storage/'.$event['poster'] }});">
        <div class="lgx-banner-style">
            <div class="lgx-inner lgx-inner-fixed">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="lgx-banner-info-area">
                                <div class="lgx-banner-info">
                                    <h2 class="title">{{$event->title}}</span></h2>
                                    <h3 class="location"><i class="fas fa-map-marked-alt"></i> {{$event->venue}},{{$event->address}}.</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--//.ROW-->
                </div>
                <!-- //.CONTAINER -->
            </div>
            <!-- //.INNER -->
        </div>
    </div>
</section>
<!--BANNER END-->

<!--ABOUT-->
<section>
    <div id="lgx-about" class="lgx-about">
        <div class="lgx-inner">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 col-sm-12 col-lg-4 offset-lg-1">
                        <div class="lgx-banner-info-area">
                            <div class="lgx-banner-info-circle lgx-info-circle">
                                <div class="info-circle-inner" style="background-image: url({{ eventmie_asset('img/bg-wave-circle.png') }});">
                                    <h3 class="date">
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $event->start_date)->format('d')}} 
                                        <span>
                                            {{\Carbon\Carbon::createFromFormat('Y-m-d', $event->start_date)->format('M-Y')}}
                                        </span>
                                    </h3>
                                    <div class="lgx-countdown-area">
                                        <!-- Date Format :"Y/m/d" || For Example: 1017/10/5  -->
                                        <div id="lgx-countdown" 
                                            data-date="{{\Carbon\Carbon::createFromFormat('Y-m-d', $event->start_date)
                                                ->format('Y/m/d')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 offset-sm-1 col-sm-10 col-lg-5">
                        <div class="lgx-about-content-area">
                            <div class="lgx-heading">
                                <h2 class="heading">{{ $event['title'] }}</h2>
                                <h3 class="subheading">
                                    <span class="lgx-badge lgx-badge-info">{{ $category['name'] }}</span>
                                    <span class="lgx-badge lgx-badge-success">@lang('eventmie::em.free') @lang('eventmie::em.tickets')</span>
                                    
                                    @if($ended)   
                                    <span class="lgx-badge lgx-badge-danger">@lang('eventmie::em.event') @lang('eventmie::em.ended')</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="lgx-about-content">{!! $event['description'] !!}</div>
                        </div>
                    </div>

                </div>
                <br><br>
                <div class="row">
                    <div class="col-12 col-sm-5 col-md-5 offset-md-1">
                        <div class="lgx-about-service">
                            <div class="lgx-single-service lgx-single-service-color">
                                <span class="icon"><i class="fas fa-map-marked-alt" aria-hidden="true"></i></span>
                                <div class="text-area">
                                    <h2 class="title">@lang('eventmie::em.where')</h2>
                                    <p>
                                        <strong>{{$event->venue}}</strong> <br>
                                        {{$event->address}} {{ $event->zipcode }} <br>
                                        {{ $event->city }}, 
                                        {{ $event->state }}, 
                                        {{ $country['country_name'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-5 col-md-5">
                        <div class="lgx-about-service">
                             <div class="lgx-single-service lgx-single-service-color">
                                <span class="icon"><i class="fas fa-stopwatch" aria-hidden="true"></i></span>
                                <div class="text-area">
                                    <h2 class="title">@lang('eventmie::em.when')</h2>
                                    <p>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $event->start_date)->format('d M Y') }}, 
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $event->start_date)->format('l') }}, 
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', $event->start_date.''.$event->start_time)->format('h:m A') }}

                                        <br>@lang('eventmie::em.till')<br>

                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $event->end_date)->format('d M Y') }}, 
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $event->end_date)->format('l') }}, 
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', $event->end_date.''.$event->end_time)->format('h:m A') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- //.CONTAINER -->
        </div><!-- //.INNER -->
    </div>
</section>
<!--ABOUT END-->

<!--Ticket Booking-->
<section>
    <div id="lgx-schedule" class="lgx-schedule">
        <div class="lgx-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="lgx-registration-area-simple">
                            <div class="lgx-heading lgx-heading-white">
                                <h2 class="heading">@lang('eventmie::em.get_tickets')</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <select-dates :event="{{ json_encode($event, JSON_HEX_APOS) }}" 
                        :max_ticket_qty="{{ json_encode($max_ticket_qty, JSON_HEX_APOS) }}">
                    </select-dates>
                </div>
                <!--//.ROW-->
            </div>
            <!-- //.CONTAINER -->
        </div>
        <!-- //.INNER -->
    </div>
</section>
<!--Ticket Booking END-->



<!--Event FAQ-->
<section>
    <div id="lgx-about" class="lgx-about">
        <div class="lgx-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="lgx-heading">
                            <h2 class="heading">@lang('eventmie::em.event') @lang('eventmie::em.info')</h2>
                        </div>
                    </div>
                    <!--//main COL-->
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="lgx-about-content-area text-center">
                            <div class="lgx-about-content">{!! $event['faq'] !!}</div>
                        </div>
                    </div>
                </div>
                <!--//.ROW-->
            </div>
            <!-- //.CONTAINER -->
        </div>
    </div>
</section>
<!--Event FAQ END-->


<!--PHOTO GALLERY-->
@if(!empty($event->images))
<section>
    <div id="lgx-photo-gallery" class="lgx-gallery-popup lgx-photo-gallery-normal lgx-photo-gallery-black">
        <div class="lgx-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="lgx-heading lgx-heading-white">
                            <h2 class="heading">@lang('eventmie::em.event') @lang('eventmie::em.gallery')</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="lgx-gallery-area">
                            @foreach(json_decode($event->images, true) as $item)
                            <div  class="lgx-gallery-single">
                                <figure>
                                    <img title="{{ $event->title }}" src="/storage/{{ $item }}" alt="{{ $event->slug }}" style="height: 280px;"/>
                                </figure>
                            </div> <!--Single photo-->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!--PHOTO GALLERY END-->

@endsection


@section('javascript')
<script type="text/javascript" src="{{ eventmie_asset('js/events_show.js') }}"></script>
@stop