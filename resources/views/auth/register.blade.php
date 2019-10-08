@extends('eventmie::auth.authapp')

@section('title')
    @lang('eventmie::em.register')
@endsection

@section('authcontent')

<h2 class="title">@lang('eventmie::em.register')</h2>
<div class="lgx-registration-form">
    <form method="POST" action="{{ route('eventmie.register') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input id="name" type="text" class="wpcf7-form-control form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="@lang('eventmie::em.name')">
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif

        <input id="email" type="email" class="wpcf7-form-control form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="@lang('eventmie::em.email')">
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
            <input class="form-check-input" type="checkbox" name="accept" id="accept" checked value="1">
            <label class="form-check-label" for="accept">
                @lang('eventmie::em.accept') &nbsp;<a href="{{ route('eventmie.page', ['page'=>'terms']) }}"> @lang('eventmie::em.terms')</a>
            </label>
        </div>

        <button type="submit" class="lgx-btn lgx-btn-white btn-block"><i class="fas fa-door-open"></i> @lang('eventmie::em.register')</button>

        <div class="row">
            <div class="col-md-12">
                <div class="lgx-links">
                    <a class="btn btn-link pull-left" href="{{ route('eventmie.password.request') }}">
                        @lang('eventmie::em.forgot') @lang('eventmie::em.password')
                    </a>
                    <a class="btn btn-link pull-right" href="{{ route('eventmie.login') }}">
                        @lang('eventmie::em.login')
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection