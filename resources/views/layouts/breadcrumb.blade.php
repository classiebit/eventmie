 <!--Page breadcrumb-->
<section>
    <div id="lgx-schedule" class="lgx-schedule lgx-schedule-dark">
        <div class="lgx-inner-breadcrumb" style="background-image: url({{ eventmie_asset('img/bg-pattern.png') }});">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="breadcrumb-area">
                            <div class="breadcrumb-heading-area">
                                <h2 class="breadcrumb-heading">@yield('title')</h2>
                            </div>

                            <ol class="breadcrumb">
                                <li>
                                    <i class="fas fa-home"></i>
                                    <a href="{{route('eventmie.welcome')}}">@lang('eventmie::em.home')</a>
                                </li>

                                @php 
                                    $i_count = 1;
                                    if(config('eventmie.route.prefix')) 
                                    {
                                        $i_count = 2;
                                        $prefix_count = count(explode('/', config('eventmie.route.prefix')));
                                        if($prefix_count > 1)
                                            $i_count = $prefix_count+1;
                                    }
                                @endphp
                                
                                @for($i = $i_count; $i <= count(Request::segments()); $i++)
                                    @if($i != count(Request::segments()) )
                                        <li>
                                            <a href="{{ URL::to( implode( '/', array_slice(Request::segments(), 0 ,$i, true)))}}">
                                                {{strtoupper(Request::segment($i))}}
                                            </a>
                                        </li>
                                    @else
                                        <li class="active">
                                            {{ strtoupper(Request::segment($i)) }}    
                                        </li>
                                    @endif    
                                @endfor
                            </ol>
                        </div>
                    </div>
                </div><!--//.ROW-->
            </div><!-- //.CONTAINER -->
        </div><!-- //.INNER -->
    </div>
</section> <!--//.Banner Inner-->