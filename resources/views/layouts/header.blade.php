<div id="navbar_vue"
    class="nav-header nav-header-classic {{ \Str::contains(url()->current(), 'dashboard') ? 'shadow menu-fixed nav-dashboard' : 'menu-space header-position header-white' }}">
    <div class="{{ \Str::contains(url()->current(), 'dashboard') ? 'dashboard-container' : 'container' }}">
        <div class="row">
            <div class="col-md-12">
                <!-- GDPR -->
                <cookie-law theme="gdpr" button-text="@lang('eventmie::em.accept')">
                    <div slot="message">
                        <gdpr-message></gdpr-message>
                    </div>
                </cookie-law>
                <!-- GDPR -->

                <!-- Vue Alert message -->
                @if ($errors->any())
                    <alert-message :errors="{{ json_encode($errors->all(), JSON_HEX_APOS) }}"></alert-message>
                @endif

                @if (session('status'))
                    <alert-message :message="'{{ session('status') }}'"></alert-message>
                @endif
                <!-- Vue Alert message -->

                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand pr-5" href="{{ url('') }}">
                        <img src="/storage/{{ setting('site.logo') }}"
                            class="mx-auto d-blocks {{ App::isLocale('ar') ? 'float-end' : 'float-start' }}"
                            alt="{{ setting('site.site_name') }}" style="height:50px;" />
                        <div class="my-2">
                            <p class="py-0 my-0 l-height site-name">
                                &nbsp;&nbsp;{{ setting('site.site_name') }}
                            </p>
                            <p class="py-0 my-0 site-slogan">
                                &nbsp;&nbsp;{{ setting('site.site_slogan') }}
                            </p>
                        </div>
                    </a>
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>


                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-lg-3">
                            <!-- Authentication Links -->
                            @guest
                                @include('eventmie::layouts.guest_header')
                            @else
                                @include('eventmie::layouts.member_header')
                            @endguest

                            {{-- Common Header --}}
                            {{-- categories menu items --}}
                            @php $categoriesMenu = categoriesMenu() @endphp
                            @if (!empty($categoriesMenu))

                                <li class="nav-item dropdown ">
                                    <a class="nav-link dropdown-toggle" href="#" id="homeDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="fas fa-bars-staggered"></i>
                                        @lang('eventmie::em.categories')&nbsp;<i class="fas fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach ($categoriesMenu as $val)
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('eventmie.events_index', ['category' => urlencode($val->name)]) }}">
                                                    {{ $val->name }}
                                                </a>

                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                            @endif


                        </ul>

                        @if(config('voyager.demo_mode'))
                        <a class="btn btn-success d-none d-lg-block me-2" target="_blank" href="https://github.com/classiebit/eventmie"><i class="fab fa-github col-black"></i></a>
                        @endif

                        <a href="{{ route('eventmie.events_index') }}"
                            class="btn btn-primary d-none d-lg-block bg-gradient">
                            <i class="fas fa-calendar-day"></i> @lang('eventmie::em.browse_events')
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
