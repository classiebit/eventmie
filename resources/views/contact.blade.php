@extends('eventmie::layouts.app')

@section('title')
    @lang('eventmie::em.contact')
@endsection
@section('meta_title') @lang('eventmie::em.contact') @endsection
@section('meta_description', setting('site.site_name') ? setting('site.site_name') : config('app.name'))
@section('meta_url', url()->current())

@section('content')

    <main>
        <!--News-->
        <section>
            <div class="pb-lg-12 pb-7">
                <div class="container">

                    <div class="row justify-content-center mt-8">
                        <div class="col-lg-8 col-md-12 col-12">
                            <div>
                                @if (\Session::has('msg'))
                                    <div class="alert alert-success">
                                        {{ \Session::get('msg') }}
                                    </div>
                                @endif
                                <!-- form -->
                                <form class="row needs-validation" novalidate="" method="POST"
                                    action="{{ route('eventmie.store_contact') }}">
                                    @csrf
                                    <!-- first name -->
                                    <div class="mb-3 col-md-6">
                                        <label for="fname" class="form-label">@lang('eventmie::em.name') <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="@lang('eventmie::em.name')" required="">
                                        <div class="invalid-feedback">
                                            @if ($errors->has('name'))
                                                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- email -->
                                    <div class="mb-3 col-md-6">
                                        <label for="lname" class="form-label">@lang('eventmie::em.email') <span
                                                class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control" id="lname"
                                            placeholder="@lang('eventmie::em.email')" required="">
                                        <div class="invalid-feedback">
                                            @if ($errors->has('email'))
                                                <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- title -->
                                    <div class="mb-3 col-md-12">
                                        <label for="title" class="form-label">@lang('eventmie::em.title') <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="@lang('eventmie::em.title')" required="">
                                        <div class="invalid-feedback">
                                            @if ($errors->has('title'))
                                                <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- message -->
                                    <div class="mb-3 col-md-12">
                                        <label for="message" class="form-label">Message</label>
                                        <textarea class="form-control " rows="3" name="message" placeholder="@lang('eventmie::em.message')" id="message"
                                            required=""></textarea>
                                        @if ($errors->has('message'))
                                            <div class="alert alert-danger">{{ $errors->first('message') }}</div>
                                        @endif
                                    </div>
                                    <!-- button -->
                                    <div class="col-md-12">
                                        <button class="btn btn-primary" type="submit" value="contact-form">
                                            <span><i class="fas fa-paper-plane"></i></span> @lang('eventmie::em.send_message')</button>

                                    </div>
                                </form>
                            </div>
                            <div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>



@endsection