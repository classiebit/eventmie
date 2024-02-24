<section class="bg-gradient">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12 mt-15">
                <!-- content -->
                <h2 class="text-white fw-bold mb-2">@yield('title')</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item ">
                            <a href="{{ route('eventmie.welcome') }}"><i class="fas fa-home text-white"></i></a>
                        </li>
                        @php
                            $i_count = 1;
                            if (config('eventmie.route.prefix')) {
                                $i_count = 2;
                                $prefix_count = count(explode('/', config('eventmie.route.prefix')));
                                if ($prefix_count > 1) {
                                    $i_count = $prefix_count + 1;
                                }
                            }
                        @endphp

                        @for ($i = $i_count; $i <= count(Request::segments()); $i++)
                            @if ($i != count(Request::segments()))
                                <li class="breadcrumb-item">
                                    <a
                                        href="{{ URL::to(implode('/', array_slice(Request::segments(), 0, $i, true))) }}">
                                        {{-- translate if variable exists  --}}
                                        @if (\Lang::has('eventmie-pro::em.' . strtolower(Request::segment($i))))
                                            @lang('eventmie-pro::em.' . strtolower(Request::segment($i)))
                                        @else
                                            {{ strtoupper(Request::segment($i)) }}
                                        @endif
                                    </a>
                                </li>
                            @else
                                <li class="breadcrumb-item active">
                                    {{-- translate if variable exists  --}}
                                    @if (\Lang::has('eventmie-pro::em.' . strtolower(Request::segment($i))))
                                        @lang('eventmie-pro::em.' . strtolower(Request::segment($i)))
                                    @else
                                        {{ strtoupper(Request::segment($i)) }}
                                    @endif
                                </li>
                            @endif
                        @endfor
                    </ol>
                </nav>
            </div>
        </div>
        <!--//.ROW-->
    </div><!-- //.CONTAINER -->
 </section>