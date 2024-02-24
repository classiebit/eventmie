<div class="footer pt-10 bg-secondary">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-3">
                <h5 class="mb-3 text-white">@lang('eventmie::em.useful_links')</h5>
                <div>
                    <ul class="list-unstyled">
                        <li><a class="text-white lh-lg"
                                href="{{ route('eventmie.page', ['page' => 'about']) }}">@lang('eventmie::em.about')</a>
                        </li>
                        <li><a class="text-white lh-lg" href="{{ route('eventmie.events_index') }}">@lang('eventmie::em.events')</a>
                        </li>
                        <li><a class="text-white lh-lg"
                                href="{{ route('eventmie.page', ['page' => 'terms']) }}">@lang('eventmie::em.terms')</a>
                        </li>
                        <li><a class="text-white lh-lg"
                                href="{{ route('eventmie.page', ['page' => 'privacy']) }}">@lang('eventmie::em.privacy')</a>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <h5 class="mb-3 text-white">@lang('eventmie::em.social')</h5>
                <div>
                    <ul class="list-unstyled">
                        @if (setting('social.facebook'))
                            <li><a href="{{ 'https://www.facebook.com/' . setting('social.facebook') }}" target="_blank"
                                    class="text-white lh-lg">@lang('eventmie::em.facebook')</a>
                        @endif
                        @if (setting('social.twitter'))
                            <li><a href="{{ 'https://twitter.com/' . setting('social.twitter') }}" target="_blank"
                                    class="text-white lh-lg">@lang('eventmie::em.twitter')</a>
                        @endif
                        @if (setting('social.instagram'))
                            <li><a href="{{ setting('social.instagram') }}" target="_blank"
                                    class="text-white lh-lg">@lang('eventmie::em.instagram')</a>
                        @endif
                        @if (setting('social.linkedin'))
                            <li><a href="{{ setting('social.linkedin') }}" target="_blank"
                                    class="text-white lh-lg">@lang('eventmie::em.linkedin')</a>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <h5 class="mb-3 text-white">@lang('eventmie::em.contact')</h5>
                <div>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('eventmie.contact') }}" class="text-white lh-lg">@lang('eventmie::em.contact_send_message')</a>
                        </li>
                        <li><a href="{{ route('eventmie.contact') }}" class="text-white lh-lg">@lang('eventmie::em.contact_find_us')</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <img class="w-50 mx-auto" src="/storage/{{ setting('site.logo') }}"
                    alt="{{ setting('site.site_name') }}" />
            </div>
        </div>

        
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 h-scroll">

                <ul
                    class="list-group list-group-horizontal list-group-flush justify-content-lg-center justify-content-md-between m-auto">
                    @foreach (lang_selector() as $val)
                        <li class="list-group-item bg-secondary border-0 p-1">
                            <a class="text-center col-grey px-2 text-white {{ $val == config('app.locale') ? 'active' : '' }}"
                                href="{{ route('eventmie.change_lang', ['lang' => $val]) }}">
                                @lang('eventmie::em.lang_' . $val)
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-12 text-center">
                <p class="fs-6 text-gray-500 pb-3">
                    <span>©</span> {{ date('Y') }}
                    <a
                        href="{{ eventmie_url() }}">{{ setting('site.site_name') ? setting('site.site_name') : config('app.name') }}</a><br>

                    @if (!empty(setting('site.site_footer')))
                        {!! setting('site.site_footer') !!}
                    @endif
                </p>
            </div>
        </div>
    </div>
    <!-- tiny footer  -->
    <!-- footer section -->
</div>
<!-- footer section -->
</div>
