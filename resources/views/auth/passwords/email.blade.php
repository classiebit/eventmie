@extends('eventmie::auth.authapp')

@section('title')
    @lang('eventmie::em.forgot') @lang('eventmie::em.password')
@endsection

@section('authcontent')

<h2 class="title">@lang('eventmie::em.forgot') @lang('eventmie::em.password')</h2>

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<div class="lgx-registration-form">
    <form method="POST" action="{{ route('eventmie.password.email') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <input id="email" type="email" class="wpcf7-form-control form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="@lang('eventmie::em.email')">
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif

        <button type="submit" class="lgx-btn lgx-btn-white btn-block"><i class="fas fa-paper-plane"></i> @lang('eventmie::em.send') @lang('eventmie::em.password') @lang('eventmie::em.reset') @lang('eventmie::em.link')</button>
    </form>

    <div class="row">
        <div class="col-md-12">
            <div class="lgx-links">
                <a class="btn btn-link text-center" href="{{ route('eventmie.login') }}">@lang('eventmie::em.cancel')</a>
            </div>
        </div>
    </div>
</div>    
    
@endsection