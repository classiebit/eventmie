@extends('eventmie::layouts.app')

{{-- Page title --}}
@section('title', $page->title)

{{-- breadcrumb --}}
@section('heading', $page->title)
    
@section('content')


    <main>
        <div class="lgx-page-wrapper-none">

            <!--ABOUT-->
            <section>
                <div id="lgx-about" class="lgx-about">
                    <div class="pt-20">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="lgx-about-content-area">
                                        <div class="lgx-about-content">
                                            {!!$page->body !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- //.CONTAINER -->
                    </div><!-- //.INNER -->
                </div>
            </section>
            <!--ABOUT END-->
        </div>
    </main>

@endsection