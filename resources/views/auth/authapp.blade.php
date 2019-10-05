@extends('eventmie::layouts.app')

@section('content')

<!--BANNER-->
<section>
    <div id="lgx-schedule" class="lgx-schedule lgx-schedule-dark">
        <div class="lgx-inner" style="background-image: url({{ eventmie_asset('img/bg-pattern.png') }});">
            <div class="login-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-12 offset-sm-2 col-sm-8 col-lg-offset-3 col-lg-6">
                            <div class="lgx-registration-form-box lgx-registration-banner-box"> <!--lgx-registration-banner-box-->
                                @yield('authcontent')
                            </div>
                        </div>
                    </div>
                    <!--//.ROW-->
                </div>
                <!-- //.CONTAINER -->
            </div>
            
        </div>
        <!-- //.INNER -->
    </div>
</section>
<!--BANNER END-->

@endsection