@extends('eventmie::auth.authapp')

@section('title')
    @lang('eventmie-pro::em.forgot_password')
@endsection

@section('authcontent')
    <div class="card border-0 shadow">
        <div class="card-body p-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <h3 class="my-4">@lang('eventmie-pro::em.forgot_password')</h3>
            <!-- form -->
            <form method="POST" action="{{ route('eventmie.password.email') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <!-- email -->
                <div class="mb-3">
                    <label for="email" class="form-label">@lang('eventmie-pro::em.email_address')</label>
                    <input id="email" type="email"
                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                        value="{{ old('email') }}" required autofocus placeholder="@lang('eventmie-pro::em.email')">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary btn-block text-center">
                    <i class="fas fa-paper-plane"></i>@lang('eventmie-pro::em.send_password_reset_link')
                </button>
            </form>
            <div class="mt-3">
                <p class="mb-0">
                    <span class="ml-3">
                        <a class="btn btn-link text-center" href="{{ route('eventmie.login') }}">@lang('eventmie-pro::em.cancel')</a>
                    </span>
                </p>
            </div>

        </div>
    </div>
@endsection
