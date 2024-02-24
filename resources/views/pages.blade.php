@extends('eventmie::layouts.app')

@section('meta_title', $page->title)
@section('meta_description', setting('site.site_name') ? setting('site.site_name') : config('app.name'))
@section('meta_url', url()->current())

@if (!empty($page))
    {{-- Page title --}}
    @section('title', $page->title)

    {{-- breadcrumb --}}
    @section('heading', $page->title)

    @section('content')
        <main>
            <!--ABOUT-->
            <section>
                <div class="py-6 py-lg-8 ">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12  col-12">
                                <p>
                                    {!! $page->body !!}
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--ABOUT END-->
        </main>
    @endsection
@endif
