<!--FOOTER-->
<footer>
    <div id="lgx-footer" class="lgx-footer-black"> <!--lgx-footer-white-->
        <div class="lgx-inner-footer">
            <div class="container">
                <div class="lgx-footer-area">
                    <div class="lgx-footer-single footer-brand">
                        <img class="footer-brand-logo" src="/storage/{{ setting('site.logo') }}" alt="{{ setting('site.site_name') }}"/>
                        <p class="footer-brand-name">{{ setting('site.site_name') }}</p>
                        <p class="footer-brand-slogan">{{ setting('site.site_slogan') }}</p>
                    </div> <!--//footer-area-->
                    <div class="lgx-footer-single">
                        <h3 class="footer-title">@lang('eventmie::em.useful') @lang('eventmie::em.links')</h3>
                        <ul class="list-unstyled">
                            <li><a class="col-grey" href="{{ route('eventmie.about') }}">@lang('eventmie::em.about')</a></li>
                            <li><a class="col-grey" href="{{ eventmie_url('events') }}">@lang('eventmie::em.events')</a></li>
                            <li><a class="col-grey" href="{{ route('eventmie.terms') }}">@lang('eventmie::em.terms')</a></li>
                            <li><a class="col-grey" href="{{ route('eventmie.privacy') }}">@lang('eventmie::em.privacy')</a></li>
                        </ul>
                    </div>
                    <div class="lgx-footer-single">
                        <h3 class="footer-title">@lang('eventmie::em.contact')</h3>
                        <a href="{{ route('eventmie.contact') }}"><h4 class="date">@lang('eventmie::em.contact_send_message')</h4></a>
                        <address>{{ setting('contact.address') }}</address>
                        
                        <p><i class="fas fa-envelope" aria-hidden="true"></i> &nbsp;{{ setting('contact.email') }}</p>
                        <p><i class="fas fa-mobile" aria-hidden="true"></i> &nbsp;{{ setting('contact.phone') }}</p>
                    </div>
                    <div class="lgx-footer-single">
                        <h3 class="footer-title">@lang('eventmie::em.social')</h3>
                        <p class="text">@lang('eventmie::em.social_find')</p>
                        <ul class="list-inline lgx-social-footer">
                            <li><a href="{{ 'https://www.facebook.com/'.setting('social.facebook') }}" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                            <li><a href="{{ 'https://twitter.com/'.setting('social.twitter') }}" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="{{ setting('social.instagram') }}" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="{{ setting('social.linkedin') }}" target="_blank"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                  
                </div>
                
                <div class="lgx-footer-bottom">
                    <div class="lgx-copyright">
                        <p> 
                            <span>©</span> {{ date('Y') }} 
                            <a href="#">{{ setting('site.site_name') }}</a>.
                            @lang('eventmie::em.product_by') <a href="https://www.classiebit.com" target="_blank">Classiebit</a> 
                        </p>
                    </div>
                </div>

            </div>
            <!-- //.CONTAINER -->
        </div>
        <!-- //.footer Middle -->
    </div>
</footer>
<!--FOOTER END-->