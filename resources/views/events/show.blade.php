@extends('eventmie::layouts.app')

@section('title', $event->title)
@section('meta_title', $event->meta_title)
@section('meta_keywords', $event->meta_keywords)
@section('meta_description', $event->meta_description)
@section('meta_image', getStorageImage($event['thumbnail']))
@section('meta_url', url()->current())


@section('content')

    <!--ABOUT-->
    <section>
        <div class="pb-lg-11 py-2 mt-7">
            <div class="container-fluid cover-img-bg" style="background-image: url({{ getStorageImage($event['thumbnail']) }});">
                <div class="row">
                    <div class="col-12 bg-dark-p3 z-3">
                        
                        <div class="row g-3">
                            <div class="col-lg-4 col-md-12 col-12 py-lg-5 pt-5 pb-2 text-lg-end text-center">
                                <div>
                                    <img src="{{ getStorageImage($event['thumbnail']) }}" alt="" class="img-fluid rounded-3">
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-12 col-12 pb-8 py-lg-5 pb-lg-8 px-4 px-lg-2">
                                <div class="text-lg-start text-center text-white">
                                    <span class="badge rounded-1 bg-dark text-white mb-1"><i class="fas fa-tag"></i> {{ $category['name'] }}</span>
                                    <h1 class="mb-2 fw-bolder mb-2 fw-bolder mb-2 fw-bolder mb-2 fw-bolder lh-1">{{ $event['title'] }}</h1>

                                    <p>
                                        <strong>{{ $event->venue }}</strong> 

                                        @if ($event->address)
                                            {{ $event->address }} {{ $event->zipcode }}
                                        @endif
                                        
                                        @if ($event->city)
                                            {{ $event->city }},
                                        @endif
        
                                        @if ($event->state)
                                            {{ $event->state }},
                                        @endif
        
                                        @if ($country)
                                            {{ $country->get('country_name') }}
                                        @endif
                                    </p>

                                    
                                    <p class="h3 fw-bolder text-priamry">
                                        <i class="fa-regular fa-clock"></i>&nbsp;
                                        @if (userTimezone($event->start_date, 'Y-m-d', 'Y-m-d') == userTimezone($event->end_date, 'Y-m-d', 'Y-m-d'))
                                            {{ userTimezone($event->start_date . ' ' . $event->start_time, 'Y-m-d H:i:s', format_carbon_date(false)) }}
                                            {{ showTimezone() }}
                                        @else
                                            {{ userTimezone($event->start_date . ' ' . $event->start_time, 'Y-m-d H:i:s', format_carbon_date(false)) }}
                                            {{ showTimezone() }}
                                            -
                                            {{ userTimezone($event->end_date . ' ' . $event->end_time, 'Y-m-d H:i:s', format_carbon_date(false)) }}
                                            {{ showTimezone() }}
                                        @endif
                                    </p>
                                    

                                    <div class="position-absolute bottom-0 mb-3">
                                        <i class="fa fa-share me-1"></i>
                                        <strong class="me-1">@lang('eventmie::em.share_event')</strong>
                                        <a class="me-1 text-white  badge text-bg-primary" target="_blank"
                                            href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                        <a class="me-1 text-white  badge text-bg-primary" target="_blank"
                                            href="https://x.com/intent/tweet?text={{ urlencode($event->title) }}&url={{ url()->current() }}">
        
                                            <i class="fab fa-x"></i>
                                        </a>
                                        <a class="me-1 text-white  badge text-bg-primary" target="_blank"
                                            href="http://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ urlencode($event->title) }}">
                                            <i class="fab fa-linkedin"></i>
                                        </a>
                                        <a class="me-1 text-white  badge text-bg-primary" target="_blank"
                                            href="https://wa.me/?text={{ url()->current() }}">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <a class="me-1 text-white  badge text-bg-primary" target="_blank"
                                            href="https://www.reddit.com/submit?title={{ urlencode($event->title) }}&url={{ url()->current() }}">
                                            <i class="fab fa-reddit"></i>
                                        </a>
        
                                        <a class="me-1 text-white  badge text-bg-primary" href="javascript:void(0)"
                                            onclick="copyToClipboard()"><i class="fas fa-link"></i></a>
                                    </div>
                                </div>
        
                                <!-- widget --> 
                                <a class="btn btn-dark btn-lg scrollEvent border-1 border-white white-shadow-lg" href="#buy-tickets">
                                    <i class="fas fa-ticket"></i> @lang('eventmie::em.get_tickets')
                                </a>
                                <!-- widget END --> 
                                
                            </div>    
                        </div>

                    </div>
                </div> 
            </div>

            <div class="container mt-5" >
                <div class="row g-3">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12">

                        <!--SCHEDULE-->
                        <div class="card border-0 mb-4 bg-light" id="buy-tickets">
                            <div class="card-body p-4">
                                <div class="mb-4 text-left">
                                    <h4 class="mb-0 fw-bold h4">@lang('eventmie::em.get_tickets')</h4>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <select-dates :event="{{ json_encode($event, JSON_HEX_APOS) }}"
                                                    :max_ticket_qty="{{ json_encode($max_ticket_qty, JSON_HEX_APOS) }}"
                                                    :login_user_id="{{ json_encode(\Auth::id(), JSON_HEX_APOS) }}"
                                                    :is_customer="{{ Auth::id() ? (Auth::user()->hasRole('customer') ? 1 : 0) : 1 }}"
                                                    :is_admin="{{ Auth::id() ? (Auth::user()->hasRole('admin') ? 1 : 0) : 0 }}"
                                                    :date_format="{{ json_encode(
                                                        [
                                                            'vue_date_format' => format_js_date(),
                                                            'vue_time_format' => format_js_time(),
                                                        ],
                                                        JSON_HEX_APOS,
                                                    ) }}">

                                                </select-dates>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--SCHEDULE END-->

                        <!-- post single -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body p-4">
                                <h4>@lang('eventmie::em.overview')</h4>
                                <p>{!! $event['description'] !!}</p>
                            </div>
                        </div>

                        <!-- post single -->

                        <!--Event FAQ-->
                        @if ($event['faq'])
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body p-4">
                                    <h4 class=" text-left">@lang('eventmie::em.event_info')</h4>
                                    <p>{!! $event['faq'] !!}</p>
                                </div>
                            </div>
                        @endif
                        <!--Event FAQ END-->



                    </div>

                    <!-- comment-form -->
                </div>
            </div>
        </div>

    </section>
    
    @if (!empty($event->images))
    <div class="z-3">
        <gallery-images :gimages="{{ $event->images }}"></gallery-images>
    </div>
    @endif
@endsection

@section('javascript')
    @vite(['vendor/classiebit/eventmie/resources/js/events_show/index.js'])
@stop