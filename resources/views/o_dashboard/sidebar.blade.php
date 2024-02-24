<div id="db-wrapper-two">
    <nav class="navbar-vertical-compact shadow-sm mt-9">
        <div data-simplebar style="" class="vh-100 mt-5">
            <ul class="navbar-nav flex-column" id="sideNavbar">

                <li class="nav-item tooltip-custom">
                    <a class="nav-link {{ Route::currentRouteName() == 'eventmie.myevents_index' || Route::currentRouteName() == 'eventmie.myevents_form' ? 'active' : '' }}"
                        href="{{ route('eventmie.myevents_index') }}" title="@lang('eventmie::em.myevents')">
                        <span class="nav-icon"><i class="far fa-calendar-alt"></i></span>
                        <span class="tooltiptext">@lang('eventmie::em.myevents')</span>
                    </a>
                </li>

            </ul>
        </div>
    </nav>
</div>
