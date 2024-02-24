@extends('eventmie::layouts.app')

@section('title', $event->title)
@section('meta_title', $event->meta_title)
@section('meta_keywords', $event->meta_keywords)
@section('meta_description', $event->meta_description)
@section('meta_image', '/storage/' . $event['thumbnail'])
@section('meta_url', url()->current())


@section('content')

    <!--Cover-->
    <section>
        <div class="container-fluid p-0">
            <div class="cover-img-bg" style="background-image: url({{ '/storage/' . $event['poster'] }});">
                <img class="cover-img" src="{{ '/storage/' . $event['poster'] }}" alt="{{ $event['title'] }}" />
            </div>
        </div>
    </section>

    <!--ABOUT-->
    <section>
        <div class="pt-lg-4 pb-lg-11 py-4">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-12 col-12">
                        <div class="card mb-4">
                            <!-- listing detail head -->
                            <div class="card-body p-4 py-3">
                                <h2 class="mb-2">{{ $event['title'] }}</h2>
                                <p class="fs-6 mb-2">
                                    <span class="badge bg-primary text-white">{{ $category['name'] }}</span>

                                    <span class="badge bg-primary text-white">@lang('eventmie::em.free_tickets')</span>

                                    @if ($ended)
                                    <span class="badge bg-danger text-white">@lang('eventmie::em.event_ended')</span>
                                    @endif
                                </p>
                            </div>
                            <div class="card-footer bg-gradient">
                                <div class="text-white">
                                    <span><strong>@lang('eventmie::em.share_event') &nbsp;</strong></span>
                                    <a class="me-1 text-white  badge text-bg-primary" target="_blank"
                                        href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                    <a class="me-1 text-white  badge text-bg-primary" target="_blank"
                                        href="https://twitter.com/intent/tweet?text={{ urlencode($event->title) }}&url={{ url()->current() }}">

                                        <i class="fab fa-twitter"></i>
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
                            <!-- listing detail head -->
                        </div>
                        <!--SCHEDULE-->
                        <div class="card mb-4 bg-light" id="buy-tickets">
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
                        <div class="card mb-4">
                            <div class="card-body p-4">
                                <h4>@lang('eventmie::em.overview')</h4>
                                <p>{!! $event['description'] !!}</p>
                            </div>
                        </div>

                        <!-- post single -->

                        <!--Event FAQ-->
                        @if ($event['faq'])
                            <div class="card mb-4">
                                <div class="card-body p-4">
                                    <h4 class=" text-left">@lang('eventmie::em.event_info')</h4>
                                    <p>{!! $event['faq'] !!}</p>
                                </div>
                            </div>
                        @endif
                        <!--Event FAQ END-->

                        <!--PHOTO GALLERY-->
                        @if (!empty($event->images))
                            <div class="card mb-4">
                                <div class="card-body p-4 pb-0">
                                    <h4 class="mb-3">@lang('eventmie::em.event_gallery')</h4>
                                    <gallery-images :gimages="{{ $event->images }}" :style=''>
                                    </gallery-images>
                                </div>
                            </div>
                        @endif
                        <!--PHOTO GALLERY END-->

                    </div>

                    <!-- comment-form -->

                    {{-- Event Start Date Start --}}
                    <div class="col-xl-4 col-lg-4 col-md-12 col-12">

                        <!-- widget -->
                        <div class="card mb-4">
                            <div class="card-body p-4">
                                <div class="d-grid">
                                    <a class="btn btn-primary btn-lg " href="#buy-tickets">
                                        <i class="fas fa-ticket-alt"></i>
                                        @lang('eventmie::em.get_tickets')
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                                <!-- card-->
                                <h4 class="mb-2 fw-bold">@lang('eventmie::em.where')</h4>
                                <p>
                                    <strong>{{ $event->venue }}</strong>

                                    <br>
                                    @if ($event->address)
                                        {{ $event->address }} {{ $event->zipcode }} <br>
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

                            </div>
                        </div>

                        <!-- card-->
                        <div class="card  mb-4">
                            <div class="card-body">
                                <h4 class="mb-2 fw-bold">@lang('eventmie::em.when')</h4>
                                    <p>
                                        {{ userTimezone($event->start_date . ' ' . $event->start_time, 'Y-m-d H:i:s', format_carbon_date(false)) }}

                                        {{ showTimezone() }}

                                        -

                                        {{ userTimezone($event->end_date . ' ' . $event->end_time, 'Y-m-d H:i:s', format_carbon_date(false)) }}

                                        {{ showTimezone() }}
                                    </p>
                                

                            </div>
                        </div>

                    </div>
                    {{-- Event Start Date End --}}
                </div>
            </div>
        </div>

    </section>
    <!--ABOUT END-->
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ eventmie_asset('js/events_show.js') }}"></script>
@stop
