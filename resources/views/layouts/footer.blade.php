<div class="footer pt-8 pb-2">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <img src="{{ getStorageImage(setting('site.logo')) }}" alt="{{ setting('site.site_name') }}" class="img-fluid mb-2" style="max-height: 80px;">
                <p class="fs-5 fw-bold mb-0">{{ setting('site.site_name') }}</p>
                <p class="small opacity-75">{{ setting('site.site_slogan') }}</p>
                
                <p class="small mb-0 text-gray-500">&copy; {{ date('Y') }} <a class="footer-link fw-bold" href="{{ eventmie_url() }}">{{ setting('site.site_name') ?? config('app.name') }}</a></p>
                <p>@if (!empty(setting('site.site_footer'))) {!! setting('site.site_footer') !!}@endif</p>
            </div>
            <div class="col-md-8 d-flex flex-wrap justify-content-between">
                <div class="footer-column text-start">
                    <h6 class="fw-bold mb-2">@lang('eventmie::em.useful_links')</h6>
                    <ul class="list-unstyled small lh-lg">
                        <li><a class="footer-link" href="{{ route('eventmie.page', ['page' => 'about']) }}">@lang('eventmie::em.about')</a></li>
                        <li><a class="footer-link" href="{{ route('eventmie.events_index') }}">@lang('eventmie::em.events')</a></li>
                        <li><a class="footer-link" href="{{ route('eventmie.page', ['page' => 'terms']) }}">@lang('eventmie::em.terms')</a></li>
                        <li><a class="footer-link" href="{{ route('eventmie.page', ['page' => 'privacy']) }}">@lang('eventmie::em.privacy')</a></li>
                    </ul>
                </div>
                <div class="footer-column text-start">
                    <h6 class="fw-bold mb-2">@lang('eventmie::em.social')</h6>
                    <ul class="list-unstyled small lh-lg">
                        @if (setting('social.facebook')) <li><a class="footer-link" href="https://www.facebook.com/{{ setting('social.facebook') }}" target="_blank">@lang('eventmie::em.facebook')</a></li> @endif
                        @if (setting('social.twitter')) <li><a class="footer-link" href="https://x.com/{{ setting('social.twitter') }}" target="_blank">@lang('eventmie::em.twitter')</a></li> @endif
                        @if (setting('social.instagram')) <li><a class="footer-link" href="{{ setting('social.instagram') }}" target="_blank">@lang('eventmie::em.instagram')</a></li> @endif
                        @if (setting('social.linkedin')) <li><a class="footer-link" href="{{ setting('social.linkedin') }}" target="_blank">@lang('eventmie::em.linkedin')</a></li> @endif
                    </ul>
                </div>
                <div class="footer-column text-start">
                    <h6 class="fw-bold mb-2">@lang('eventmie::em.contact')</h6>
                    <ul class="list-unstyled small lh-lg">
                        <li><a class="footer-link" href="{{ route('eventmie.contact') }}">@lang('eventmie::em.contact_send_message')</a></li>
                        <li><a class="footer-link" href="{{ route('eventmie.contact') }}">@lang('eventmie::em.contact_find_us')</a></li>
                    </ul>
                </div>
            </div>
        </div>

        

        <div class="row justify-content-center mb-4 mt-4">
            <div class="col-auto h-scroll h-scroll-dark">
                @foreach (lang_selector() as $val)
                    <a class="btn btn-sm btn-outline-light mx-1 {{ $val == config('app.locale') ? 'active' : '' }}" href="{{ route('eventmie.change_lang', ['lang' => $val]) }}">
                        @lang('eventmie::em.lang_' . $val)
                    </a>
                @endforeach
            </div>
        </div>

        
    </div>
</div>
