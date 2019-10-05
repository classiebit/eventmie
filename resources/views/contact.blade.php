@extends('eventmie::layouts.app')

@section('title')
    @lang('eventmie::em.contact')
@endsection
    
@section('content')

    <main>
        <div class="lgx-page-wrapper">
            <!--News-->
            <section>
                <div class="container">
                    <div class="row">

                        <div class="col-12 offset-sm-2 col-sm-8 offset-lg-3 col-lg-6">
                            @if (\Session::has('msg'))
                                <div class="alert alert-success">
                                    {{ \Session::get('msg') }}
                                </div>
                            @endif
                            <form method="POST" class="lgx-contactform" action="{{route('eventmie.store_contact')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control lgxname" id="lgxname" placeholder="Enter Your Name" required>
                                    
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input type="email" name="email" class="form-control lgxemail" id="lgxemail" placeholder="Enter email" required>
                                    
                                    @if ($errors->has('email'))
                                        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input type="text" name="title" class="form-control lgxsubject" id="lgxsubject" placeholder="Subject" required>
                                    
                                    @if ($errors->has('title'))
                                        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <textarea class="form-control lgxmessage" name="message" id="lgxmessage" rows="5" placeholder="We expect drop some line from you..." required></textarea>
                                    
                                    @if ($errors->has('message'))
                                        <div class="alert alert-danger">{{ $errors->first('message') }}</div>
                                    @endif
                                </div>


                                <button type="submit"  value="contact-form" class="lgx-btn lgxsend lgx-send btn-block"><span><i class="fas fa-paper-plane"></i> @lang('eventmie::em.send') @lang('eventmie::em.message')</span></button>
                            </form>

                        </div> <!--//.COL-->
                    </div>
                </div><!-- //.CONTAINER -->
            </section>
            <!--News END-->
        </div>
    </main>


@endsection