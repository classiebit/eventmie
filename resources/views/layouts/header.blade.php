<header>
    <div id="eventmie_auth_app" class="lgx-header">
        <div id="navbar_vue" class="lgx-header-position lgx-header-position-white lgx-header-position-fixed">
            <div class="lgx-container" >
                <!-- GDPR -->
                <cookie-law theme="dark-lime--rounded" button-text="@lang('eventmie::em.accept')">
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

                <nav class="navbar navbar-default lgx-navbar navbar-expand-lg">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" @click="mobileMenu()">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="lgx-logo">
                            <a href="{{ eventmie_url() }}" class="lgx-scroll">
                                <img src="/storage/{{ setting('site.logo') }}" alt="{{ setting('site.site_name') }}"/>
                                <span class="brand-name">{{ setting('site.site_name') }}</span>
                                <span class="brand-slogan">{{ setting('site.site_slogan') }}</span>
                            </a>
                        </div>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        @if(config('voyager.demo_mode'))
                        <div class="lgx-nav-right navbar-right">
                            <div class="lgx-cart-area">
                                <a class="lgx-btn lgx-btn-white lgx-btn-sm mt-2" target="_blank" href="https://github.com/classiebit/eventmie"><i class="fab fa-github fa-2x col-black"></i></a>
                            </div>
                        </div>
                        @endif

                        <div class="lgx-nav-right navbar-right">
                            <div class="lgx-cart-area">
                                <a class="lgx-btn lgx-btn-red" href="{{ eventmie_url('events') }}"><i class="fas fa-calendar-day"></i> @lang('eventmie::em.browse') @lang('eventmie::em.events')</a>
                            </div>
                        </div>
                        <ul class="nav navbar-nav lgx-nav navbar-right">
                            <!-- Authentication Links -->
                            @guest
                            <li>
                                <a class="lgx-scroll" href="{{ route('eventmie.login') }}"><i class="fas fa-fingerprint"></i> @lang('eventmie::em.login')</a>
                            </li>
                            @else

                                @if(!\Auth::user()->hasRole('admin'))
                                <li>
                                    @php
                                        $data  = notifications();
                                    @endphp

                                    <a id="navbarDropdown" class="dropdown-toggle active" href="#" data-toggle="dropdown" role="button" aria-haspopup="true"            aria-expanded="false" v-pre>
                                        <i class="fas fa-bell"> </i> 
                                        
                                        <span class="badge bg-red">{{$data['total_notify']}}</span> 
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        @if(!empty($data['notifications']))      
                                            @foreach ($data['notifications'] as $notification) 
                                            <li>
                                                <a class="dropdown-item" href="{{route('eventmie.notify_read', [$notification->n_type])}}"> 
                                                    {{ $notification->total    }}
                                                    {{ $notification->n_type    }}
                                                </a>
                                            </li>
                                            @endforeach
                                        @else
                                        <li>
                                            <a class="dropdown-item" > @lang('eventmie::em.no') @lang('eventmie::em.notifications')</a>
                                        </li>
                                        @endif
                                    </ul>
                                </li>
                                @endif
                            
                            <li>
                                <a id="navbarDropdown" class="dropdown-toggle active" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if(Auth::user()->hasRole('customer'))
                                    <i class="fas fa-user-circle"></i> 
                                    @else
                                    <i class="fas fa-user-shield"></i> 
                                    @endif

                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu multi-level">

                                    {{-- for customers --}}
                                    @if(Auth::user()->hasRole('customer'))
                                    <li>
                                        <a class="dropdown-item" href="{{ route('eventmie.profile') }}"><i class="fas fa-id-card"></i> @lang('eventmie::em.profile')</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('eventmie.mybookings_index') }}"><i class="fas fa-money-check-alt"></i> @lang('eventmie::em.my') @lang('eventmie::em.bookings')</a>
                                    </li>
                                    @endif

                                    @if(Auth::user()->hasRole('admin'))
                                    <li>
                                        <a class="dropdown-item" href="{{ eventmie_url().'/'.config('eventmie.route.admin_prefix') }}">
                                        <i class="fas fa-tachometer-alt"></i>  @lang('eventmie::em.admin_panel')</a>
                                    </li>
                                    @endif

                                    <li>
                                        <a class="dropdown-item" href="{{ route('eventmie.logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i> @lang('eventmie::em.logout')
                                        </a>
                                        <form id="logout-form" action="{{ route('eventmie.logout') }}" method="POST" style="display: none;">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                    </li>

                                </ul>
                            </li>

                                {{-- If user is admin then show admin panel link --}}
                                @if(Auth::user()->hasRole('admin'))
                                <li>
                                    <a class="lgx-scroll" href="{{ route('eventmie.myevents_form') }}">
                                    <i class="fas fa-calendar-plus"></i> @lang('eventmie::em.create') @lang('eventmie::em.event')</a>
                                </li>
                                @endif

                                {{-- If user is customer then show my bookings link --}}
                                @if(Auth::user()->hasRole('customer'))
                                <li>
                                    <a class="lgx-scroll" href="{{ route('eventmie.mybookings_index') }}">
                                    <i class="fas fa-money-check-alt"></i> @lang('eventmie::em.my') @lang('eventmie::em.bookings')</a>
                                </li>
                                @endif

                            @endguest

                            <li>
                                <a id="navbarDropdown" class="dropdown-toggle active" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-globe"></i> 
                                    @lang('eventmie::em.'.config('app.locale'))
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach(lang_selector() as $val)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('eventmie.change_lang', ['lang' => $val]) }}">@lang('eventmie::em.'.$val)</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>

                        </ul>
                    </div><!--/.nav-collapse -->
                </nav>
            </div>
            <!-- //.CONTAINER -->
        </div>
    </div>
</header>