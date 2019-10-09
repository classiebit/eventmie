@extends('eventmie::auth.authapp')

@section('title')
    @lang('eventmie::em.login')
@endsection

@section('authcontent')

<h2 class="title">@lang('eventmie::em.login')</h2>

@if(config('voyager.demo_mode'))
<div class="alert alert-info">
    <a href="https://eventmie-docs.classiebit.com/docs/1.0/demo-accounts" target="_blank">Visit here for Demo Accounts</a>    
</div>
@endif

<div class="lgx-registration-form">
    <form method="POST" action="{{ route('eventmie.login_post') }}">
        
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input id="email" type="email" class="wpcf7-form-control form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="@lang('eventmie::em.email')">
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif

        <input id="password" type="password" class="wpcf7-form-control form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="@lang('eventmie::em.password')">
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
        
        <div class="form-check text-left">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" checked value="1">
            <label class="form-check-label" for="remember">@lang('eventmie::em.remember')</label>
        </div>
        
        <button type="submit" class="lgx-btn lgx-btn-white btn-block"><i class="fas fa-sign-in-alt"></i> @lang('eventmie::em.login')</button>

        <div class="row">
            <div class="col-md-12">
                <div class="lgx-links">
                    <a class="btn btn-link pull-left" href="{{ route('eventmie.password.request') }}">@lang('eventmie::em.forgot') @lang('eventmie::em.password')</a>
                    <a class="btn btn-link pull-right" href="{{ route('eventmie.register') }}">@lang('eventmie::em.register')</a>
                </div>
            </div>
        </div>
        
    </form>
</div>    

@endsection
