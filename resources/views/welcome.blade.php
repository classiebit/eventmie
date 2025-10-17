@extends('eventmie::layouts.app')

@section('title', setting('seo.meta_title'))
@section('meta_description', setting('seo.meta_description'))

@section('content')
    @php
        $perPage = 3;
    @endphp
    <!--Banner slider start-->
    <section class="bg-dark mt-8">
        <div class="col-sm-12">
            <banner-slider 
                :banners="{{ json_encode($banners, JSON_HEX_APOS) }}" 
                :demo_mode="{{ config('voyager.demo_mode') }}"
            ></banner-slider>
            
        </div>
    </section>
    <!--Banner slider end-->

    {{-- Modern Search Form --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <div class="search-form-container mt-n5 position-relative">
                    <div class="search-form-card bg-white rounded-4 shadow-lg border-0 overflow-hidden">
                        <form method="GET" action="{{ route('eventmie.events_index') }}" class="search-form">
                            <div class="row g-0">
                                <!-- City Filter -->
                                <div class="col-md-4 col-12">
                                    <div class="search-field position-relative">
                                        <div class="field-icon">
                                            <i class="fas fa-map-marker-alt text-muted"></i>
                                        </div>
                                        <select class="form-select modern-select" id="city" name="city" aria-label="{{ __('eventmie::em.city') }}">
                                            <option value="All">@lang('eventmie::em.all')</option>
                                            @foreach ($cities as $val)
                                                <option value="{{ $val['city'] }}">{{ $val['city'] }}, {{ $val['state'] }}</option>
                                            @endforeach
                                        </select>
                                        <label for="city" class="field-label">{{ __('eventmie::em.city') }}</label>
                                    </div>
                                </div>
                                
                                <!-- Category Filter -->
                                <div class="col-md-4 col-12">
                                    <div class="search-field position-relative">
                                        <div class="field-icon">
                                            <i class="fas fa-tags text-muted"></i>
                                        </div>
                                        <select class="form-select modern-select" id="category" name="category" aria-label="{{ __('eventmie::em.category') }}">
                                            <option value="All">@lang('eventmie::em.all')</option>
                                            @foreach ($categories as $val)
                                                <option value="{{ $val['name'] }}">{{ $val['name'] }}</option>
                                            @endforeach
                                        </select>
                                        <label for="category" class="field-label">{{ __('eventmie::em.category') }}</label>
                                    </div>
                                </div>
                                
                                <!-- Search Button -->
                                <div class="col-md-4 col-12">
                                    <div class="search-button-container">
                                        <button type="submit" class="btn btn-primary search-btn w-100 h-100 d-flex align-items-center justify-content-center">
                                            <i class="fas fa-search me-2"></i>
                                            <span class="d-none d-md-inline">@lang('eventmie::em.search')</span>
                                            <span class="d-md-none">@lang('eventmie::em.search')</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- New Themes Top-selling Start-->
    @if ($top_selling_events->isNotEmpty())
        <div class="py-3">
            <div class="container">
                <div class="row">
                    <div class="col-8">
                        <h3 class="h5">@lang('eventmie::em.top_selling_events')</h3>
                    </div>
                    <div class="col-4">
                        <a class="btn btn-sm text-primary mt-lg-2 {{ App::isLocale('ar') ? 'float-start' : 'float-end' }}"
                            href="{{ route('eventmie.events_index') }}">@lang('eventmie::em.view_all') <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <event-listing :events="{{ json_encode($top_selling_events, JSON_HEX_APOS) }}"
                    :item_count="{{ 4 }}"
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
        <div class="py-3">
            <div class="container">
                <div class="row">
                    <div class="col-8">
                        <h3 class="h5">@lang('eventmie::em.upcoming_events')</h3>
                    </div>
                    <div class="col-4">
                        <a class="btn btn-sm text-primary mt-lg-2 {{ App::isLocale('ar') ? 'float-start' : 'float-end' }}"
                            href="{{ route('eventmie.events_index') }}">@lang('eventmie::em.view_all') <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <event-listing :events="{{ json_encode($upcomming_events, JSON_HEX_APOS) }}"
                 :item_count="{{ 4 }}"
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
        <div class="pt-5 pb-7 bg-gradient-primary position-relative overflow-hidden">
            <div class="container position-relative">
                <div class="row mb-3">
                    <div class="col-lg-8 col-md-10 col-12">
                        <h3 class="h5 text-white fw-bold mb-0">@lang('eventmie::em.event_categories')</h3>
                        <p class="text-white-50  mb-0 small fw-bold">@lang('eventmie::em.explore_categories')</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    @foreach ($categories as $key => $item)
                        <div class="col-6 col-md-4 col-xl-3">
                            <a href="{{ route('eventmie.events_index', ['category' => urlencode($item['name'])]) }}">
                                <div class="category-card position-relative rounded-4 overflow-hidden shadow-lg h-100 transform-hover">
                                    @php $bgimg = $item['thumb']; @endphp
                                    <div class="category-background position-absolute top-0 start-0 w-100 h-100" 
                                        style="background-image: url({{ getStorageImage($bgimg) }}); background-size: cover; background-position: center;">
                                    </div>
                                    
                                    <!-- Category Content -->
                                    <div class="category-content position-relative d-flex flex-column justify-content-end h-100 p-4">
                                        <div class="category-info">
                                            <h2 class="h3 text-white fw-bold mb-2 fs-4">{{ $item['name'] }}</h2>
                                            
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- New Themes Categories END-->

    <!-- How it works-->
    <div class="home-main-how-it-work bg-white py-5">
        <div class="container">
            <!-- Section title -->
            <h2 class="mb-2">
                <span class="font-weight-light">@lang('eventmie::em.how_it_works')</span>
            </h2>

            <!-- CSS-only tabs -->
            <div class="howit-tabs mb-3">
                
                <input type="radio" name="howit" id="tab-customer" checked>
                <label for="tab-customer" class="tab-label">
                    @lang('eventmie::em.for_customers')
                </label>

                <!-- Tab panels -->
                <div class="tab-content">
                    <!-- Customer flow -->
                    <div class="tab-panel customer mt-4">
                        <div class="row">
                            <div class="col-md-4 mb-5">
                                <div class="step position-relative ps-5">
                                    <div class="step-icon mb-3">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <h5 class="fw-semibold mb-2">
                                        @lang('eventmie::em.customer_1')
                                    </h5>
                                    <p class="text-muted">
                                        @lang('eventmie::em.customer_1_info')
                                    </p>
                                    <span class="step-number">1</span>
                                </div>
                            </div>
                            <div class="col-md-4 mb-5">
                                <div class="step position-relative ps-5">
                                    <div class="step-icon mb-3">
                                        <i class="fas fa-ticket"></i>
                                    </div>
                                    <h5 class="fw-semibold mb-2">
                                        @lang('eventmie::em.customer_2')
                                    </h5>
                                    <p class="text-muted">
                                        @lang('eventmie::em.customer_2_info')
                                    </p>
                                    <span class="step-number">2</span>
                                </div>
                            </div>
                            <div class="col-md-4 mb-5">
                                <div class="step position-relative ps-5">
                                    <div class="step-icon mb-3">
                                        <i class="fas fa-walking"></i>
                                    </div>
                                    <h5 class="fw-semibold mb-2">
                                        @lang('eventmie::em.customer_3')
                                    </h5>
                                    <p class="text-muted">
                                        @lang('eventmie::em.customer_3_info')
                                    </p>
                                    <span class="step-number">3</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.tab-content -->
            </div><!-- /.howit-tabs -->


        </div>
    </div>

@endsection

@section('javascript')
<script type="text/javascript">
    var events_slider = true;
</script>

@vite(['vendor/classiebit/eventmie/resources/js/welcome/index.js'])
@stop
