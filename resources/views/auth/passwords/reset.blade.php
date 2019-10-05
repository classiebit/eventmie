@extends('eventmie::auth.authapp')

@section('title')
    @lang('eventmie::em.reset') @lang('eventmie::em.password')
@endsection

@section('authcontent')

<h2 class="title">@lang('eventmie::em.reset') @lang('eventmie::em.password')</h2>
<div class="lgx-registration-form">
    <form method="POST" action="{{ route('eventmie.password.reset_post') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <input type="hidden" name="token" value="{{ $token }}">

        <input id="email" type="email" class="wpcf7-form-control form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus placeholder="@lang('eventmie::em.email')">
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif

        <input id="password" type="password" class="wpcf7-form-control form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="@lang('eventmie::em.new') @lang('eventmie::em.password')">
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif

        <input id="password-confirm" type="password" class="wpcf7-form-control form-control" name="password_confirmation" required placeholder="@lang('eventmie::em.confirm') @lang('eventmie::em.password')">
        
        <button type="submit" class="lgx-btn lgx-btn-white btn-block">@lang('eventmie::em.reset') @lang('eventmie::em.password')</button>
        
    </form>
</div>    
    
@endsection
