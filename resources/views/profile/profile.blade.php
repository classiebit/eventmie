@extends('eventmie::layouts.app')

@section('title')
    @lang('eventmie::em.profile')
@endsection

@section('content')

<main>
    <div class="lgx-post-wrapper">
        <section>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                    
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal" action="{{ route('eventmie.updateAuthUser')}}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group row">
                                        <label class="col-md-3">@lang('eventmie::em.name')</label>
                                        <div class="col-md-9">
                                            <input class="form-control" name="name" type="text" value="{{$user->name}}">
                                            
                                            @if ($errors->has('name'))
                                                <div class="error">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3">@lang('eventmie::em.email')</label>
                                        <div class="col-md-9">
                                            <input class="form-control"  name="email" type="email" value="{{$user->email}}">
                                            @if ($errors->has('email'))
                                                <div class="error">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <hr>
                                    <h4>@lang('eventmie::em.update_password') </h4>
                                    <hr>

                                    <div class="form-group row">
                                        <label class="col-md-3">@lang('eventmie::em.current') @lang('eventmie::em.password')</label>
                                        <div class="col-md-9">
                                            <input class="form-control" name="current" type="password" >
                                            @if ($errors->has('current'))
                                                <div class="error">{{ $errors->first('current') }}</div>
                                            @endif
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3">@lang('eventmie::em.new') @lang('eventmie::em.password')</label>
                                        <div class="col-md-9">
                                            <input class="form-control" name="password" type="password" >
                                            @if ($errors->has('password'))
                                                <div class="error">{{ $errors->first('password') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3">@lang('eventmie::em.confirm') @lang('eventmie::em.password')</label>
                                        <div class="col-md-9">
                                            <input class="form-control" name="password_confirmation" type="password" >
                                            @if ($errors->has('password_confirmation'))
                                                <div class="error">{{ $errors->first('password_confirmation') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-md-9 offset-md-3">
                                            <button class="lgx-btn" type="submit"><i class="fas fa-sd-card"></i> @lang('eventmie::em.save') @lang('eventmie::em.profile')</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection
