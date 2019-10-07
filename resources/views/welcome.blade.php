@extends('eventmie::layouts.app')

@section('title')
    @lang('eventmie::em.welcome_to') {{ setting('site.site_name') }}    
@endsection

@section('content')

<!--Banner slider start-->
<section>
    <div class="lgx-slider welcome-slider">
        <div class="lgx-banner-style">
            <div class="lgx-inner">
                <div id="lgx-main-slider" class="owl-carousel lgx-slider-navbottom">
                    <!--Vue slider-->
                    @guest
                    <banner-slider 
                        :banners="{{ json_encode($banners, JSON_HEX_APOS) }}" 
                        :is_logged="{{ 0 }}" 
                        :is_customer="{{ 0 }}"
                        :is_admin="{{ 0 }}"
                        :demo_mode="{{ config('voyager.demo_mode') }}"
                    ></banner-slider>
                    @else
                    <banner-slider 
                        :banners="{{ json_encode($banners, JSON_HEX_APOS) }}" 
                        :is_logged="{{ 1 }}" 
                        :is_customer="{{ Auth::user()->hasRole('customer') ? 1 : 0 }}"
                        :is_admin="{{ Auth::user()->hasRole('admin') ? 1 : 0 }}"
                        :demo_mode="{{ config('voyager.demo_mode') }}"
                    ></banner-slider>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</section>
<!--Banner slider end-->

<!--Event Top-selling Start-->
@if(!empty($top_selling_events))
<section>
    <div id="lgx-schedule" class="lgx-schedule lgx-schedule-dark">
        <div class="lgx-inner" style="background-image: url({{ eventmie_asset('img/bg-pattern.png') }});">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="lgx-heading lgx-heading-white">
                            <h2 class="heading"><i class="fas fa-bolt"></i> @lang('eventmie::em.top_selling') @lang('eventmie::em.events')</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="offset-1 col-10 col-lg-offset-1 col-lg-10">
                        <event-listing :events="{{ json_encode($top_selling_events, JSON_HEX_APOS) }}"></event-listing>
                    </div>
                </div>

                <div class="section-btn-area">
                    <a class="lgx-btn lgx-btn-red" href="{{ eventmie_url('events') }}"><i class="fas fa-calendar-day"></i> @lang('eventmie::em.view') @lang('eventmie::em.all') @lang('eventmie::em.events')</a>
                </div>

            </div><!-- //.CONTAINER -->
        </div><!-- //.INNER -->
    </div>
</section>
@endif
<!--Event Top-selling END-->
    
<!--Event Upcoming Start-->
@if(!empty($upcomming_events))
<section>
    <div>
        <div class="lgx-inner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="lgx-heading">
                            <h2 class="heading"><i class="fas fa-hourglass-half"></i> @lang('eventmie::em.upcoming') @lang('eventmie::em.events')</h2>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="offset-1 col-10 col-lg-offset-1 col-lg-10">
                        <event-listing :events="{{ json_encode($upcomming_events, JSON_HEX_APOS) }}"></event-listing>
                    </div>
                </div>

                <div class="section-btn-area">
                    <a class="lgx-btn lgx-btn-red" href="{{ eventmie_url('events') }}"><i class="fas fa-calendar-day"></i> @lang('eventmie::em.view') @lang('eventmie::em.all') @lang('eventmie::em.events')</a>
                </div>
                
            </div><!-- //.CONTAINER -->
        </div><!-- //.INNER -->
    </div>
</section>
@endif
<!--Event Upcoming END-->


<!--Categories-->
@if(!empty($categories))
<section>
    <div id="lgx-schedule" class="lgx-schedule lgx-schedule-dark">
        <div class="lgx-inner" style="background-image: url({{ eventmie_asset('img/bg-pattern.png') }});">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="lgx-heading lgx-heading-white">
                            <h2 class="heading">@lang('eventmie::em.event') @lang('eventmie::em.categories')</h2>
                        </div>
                    </div>
                </div>
                <!--//main row-->
                <div class="row">
                    <div class="col-12">
                        <div class="sponsors-area sponsors-area-colorfull-border">
                            @foreach($categories as $key => $item)
                            <div class="single">
                                <a href="{{route('eventmie.events_index', ['category' => urlencode($item['name'])])}}">
                                    <img src="/storage/{{ $item['thumb'] }}" alt="{{ $item['slug'] }}"/>
                                    <span class="single-name">{{ $item['name'] }}</span>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!--//col-->
                </div>
            </div>
            <!--//container-->
        </div>
    </div>
</section>
@endif   
<!--Categories END-->
    
<!--TRAVEL INFO-->
<section>
    <div id="lgx-travelinfo" class="lgx-travelinfo">
        <div class="lgx-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="lgx-heading">
                            <h3 class="subheading">@lang('eventmie::em.how_it_works')</h3>
                            <h2 class="heading">@lang('eventmie::em.for') @lang('eventmie::em.customers')</h2>
                        </div>
                    </div>
                    <!--//main COL-->
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="lgx-travelinfo-content">
                             <div class="lgx-travelinfo-single">
                                <i class="fas fa-calendar-alt fa-4x"></i>
                                <h3 class="title">1. @lang('eventmie::em.customer_1')</h3>
                                <p class="info">@lang('eventmie::em.customer_1_info')</p>
                            </div>
                            <div class="lgx-travelinfo-single">
                                <i class="fas fa-ticket-alt fa-4x"></i>
                                <h3 class="title">2. @lang('eventmie::em.customer_2')</h3>
                                <p class="info">@lang('eventmie::em.customer_2_info')</p>
                            </div>
                            <div class="lgx-travelinfo-single">
                                <i class="fas fa-walking fa-4x"></i>
                                <h3 class="title">3. @lang('eventmie::em.customer_3')</h3>
                                <p class="info">@lang('eventmie::em.customer_3_info')</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!--//.ROW-->
            </div>
            <!-- //.CONTAINER -->
        </div>
    </div>
</section>
<!--TRAVEL INFO END-->


@endsection

@section('javascript')
<script type="text/javascript" src="{{ eventmie_asset('js/welcome.js') }}"></script>
@stop