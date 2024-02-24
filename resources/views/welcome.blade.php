@extends('eventmie::layouts.app')

@section('title') @lang('eventmie::em.home') @endsection

@section('content')
    @php
        $perPage = 3;
    @endphp
    <!--Banner slider start-->
    <section>
        <div class="col-sm-12">
            @guest
                <banner-slider :banners="{{ json_encode($banners, JSON_HEX_APOS) }}" :is_logged="{{ 0 }}"
                    :is_customer="{{ 0 }}" :is_admin="{{ 0 }}"
                    :demo_mode="{{ config('voyager.demo_mode') }}"
                    ></banner-slider>
            @else
                <banner-slider :banners="{{ json_encode($banners, JSON_HEX_APOS) }}" :is_logged="{{ 1 }}"
                    :is_customer="{{ Auth::user()->hasRole('customer') ? 1 : 0 }}"
                    :is_admin="{{ Auth::user()->hasRole('admin') ? 1 : 0 }}"
                    :demo_mode="{{ config('voyager.demo_mode') }}"
                    ></banner-slider>
            @endguest
        </div>
    </section>
    <!--Banner slider end-->

    {{-- Filter --}}
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 p-2 search-form rounded-md-pill smooth-shadow-md mt-n5">
                    <form type="GET" action="{{ route('eventmie.events_index') }}">
                        <div class="row align-items-center">
                            <div class="col-sm">
                                <div class="form-floating">
                                    <select
                                        class="form-select border-bottom border-bottom-md-0 rounded-0 border-0 form-focus-none bg-transparent"
                                        id="city" name="city">
                                        <option value="All">@lang('eventmie::em.all')</option>
                                        @foreach ($cities as $val)
                                            <option value="{{ $val['city'] }}">{{ $val['city'] }}, {{ $val['state'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="city_select">{{ __('eventmie::em.city') }}</label>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-floating">
                                    <select
                                        class="form-select  border-bottom border-bottom-md-0 rounded-0 border-0 form-focus-none bg-transparent"
                                        id="category" name="category">
                                        <option value="All">@lang('eventmie::em.all')</option>
                                        @foreach ($categories as $val)
                                            <option value="{{ $val['name'] }}">{{ $val['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <label for="category">{{ __('eventmie::em.category') }}</label>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="d-md-flex justify-content-end ms-md-n3 ms-lg-0 text-end  d-none d-md-block">
                                    <button type="submit" class="btn btn-primary rounded-circle btn-icon btn-icon-lg">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                <div class="d-md-flex justify-content-end ms-md-n3 ms-lg-0  d-block d-md-none">
                                    <button type="submit"
                                        class="btn btn-primary d-grid gap-2 col-12 mx-auto">@lang('eventmie::em.search')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- New Themes Top-selling Start-->
    @if ($top_selling_events->isNotEmpty())
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-8">
                        <h3>@lang('eventmie::em.top_selling_events')</h3>
                    </div>
                    <div class="col-4">
                        <a class="btn btn-sm text-primary mt-lg-2 {{ App::isLocale('ar') ? 'float-start' : 'float-end' }}"
                            href="{{ route('eventmie.events_index') }}">@lang('eventmie::em.view_all') <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <event-listing :events="{{ json_encode($top_selling_events, JSON_HEX_APOS) }}"
                 :item_count="{{ 3 }}"
                    :date_format="{{ json_encode(
                        [
                            'vue_date_format' => format_js_date(),
                            'vue_time_format' => format_js_time(),
                        ],
                        JSON_HEX_APOS,
                    ) }}">
                </event-listing>

            </div>

        </div>
    @endif
    <!-- New Themes Top-selling END -->

    <!-- New Themes Event Upcoming Start-->
    @if ($upcomming_events->isNotEmpty())
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-8">
                        <h3>@lang('eventmie::em.upcoming_events')</h3>
                    </div>
                    <div class="col-4">
                        <a class="btn btn-sm text-primary mt-lg-2 {{ App::isLocale('ar') ? 'float-start' : 'float-end' }}"
                            href="{{ route('eventmie.events_index') }}">@lang('eventmie::em.view_all') <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <event-listing :events="{{ json_encode($upcomming_events, JSON_HEX_APOS) }}"
                 :item_count="{{ 3 }}"
                    :date_format="{{ json_encode(
                        [
                            'vue_date_format' => format_js_date(),
                            'vue_time_format' => format_js_time(),
                        ],
                        JSON_HEX_APOS,
                    ) }}">
                </event-listing>
            </div>
        </div>
    @endif
    <!-- New Themes Event Upcoming END -->

    <!-- New Themes Categories START-->
    @if (!empty($categories))
        <div class="py-5 bg-gradient">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-white">@lang('eventmie::em.event_categories')</h3>
                    </div>
                </div>
                <div class="row">
                    @php $i = 0; @endphp
                    @foreach ($categories as $key => $item)
                        @php $i++; @endphp
                        <div class="d-flex align-items-lg-stretch col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12' }}">
                            <div class="card w-100 border-0 overlay-bg img-hover mb-3"
                                @php $bgimg =  asset('/storage/'.$item['thumb']); @endphp
                                style="background-image: url({{ $bgimg }}); background-size: cover;">

                                <span class="single-name"></span>
                                <div class="pt-4 ps-4 pb-18 z-1">
                                    <h3 class="text-white mb-0">{{ $item['name'] }}</h3>
                                </div>

                                <a class="stretched-link"
                                    href="{{ route('eventmie.events_index', ['category' => urlencode($item['name'])]) }}"></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- New Themes Categories END -->

    <!-- New Themes TRAVEL INFO Start -->
    <div class="py-7 bg-light">
        <div class="container">
            <div class="row ">
                <div class="col-12">
                    <div class="text-center mb-10">
                        <p class="mb-0">@lang('eventmie::em.how_it_works') </p>
                        <h2 class="mb-1">@lang('eventmie::em.for_customers')</h2>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 col-12">
                    <div class="step text-center mb-6 mb-lg-0">
                        <div
                            class="border border-primary border-3 icon-xxxl icon-shape rounded-circle bg-white mb-lg-7 mb-3">
                            <div class="icon-shape icon-xl bg-white shadow rounded-circle ">
                                <i class="fas fa-calendar-alt fa-1x text-primary"></i>
                            </div>
                        </div>
                        <h3 class="mb-3">1. @lang('eventmie::em.customer_1')</h3>
                        <p class="mb-0 px-lg-3">@lang('eventmie::em.customer_1_info') </p>
                    </div>

                </div>
                <div class="col-md-4 col-12">
                    <div class="step text-center mb-6 mb-lg-0">
                        <div class="border border-info border-3 icon-xxxl icon-shape rounded-circle bg-white mb-lg-7 mb-3">
                            <div class="icon-shape icon-xl bg-white shadow rounded-circle ">
                                <i class="fas fa-ticket-alt fa-1x text-primary"></i>
                            </div>
                        </div>
                        <h3 class="mb-3">2. @lang('eventmie::em.customer_2')</h3>
                        <p class="mb-0 px-lg-3">@lang('eventmie::em.customer_2_info')</p>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="text-center mb-6 mb-lg-0">
                        <div
                            class="border border-success border-3 icon-xxxl icon-shape rounded-circle bg-white mb-lg-7 mb-3">
                            <div class="icon-shape icon-xl bg-white shadow rounded-circle ">
                                <i class="fas fa-walking fa-1x text-primary"></i>
                            </div>
                        </div>
                        <h3 class="mb-3">3. @lang('eventmie::em.customer_3')</h3>
                        <p class="mb-0 px-lg-3">@lang('eventmie::em.customer_3_info') </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Themes TRAVEL INFO End -->

@endsection

@section('javascript')
<script type="text/javascript">
    var events_slider = true;
</script>
<script type="text/javascript" src="{{ eventmie_asset('js/welcome.js') }}"></script>
@stop
