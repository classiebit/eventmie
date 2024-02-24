@extends('eventmie::auth.authapp')

@section('title')
    @lang('eventmie::em.register')
@endsection

@section('authcontent')

    <div class="card border-0 shadow">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            <span class="" role="alert">
                                <strong>{{ $error }}</strong>
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-body p-5">


            <h3 class="mb-4">@lang('eventmie::em.register')</h3>
            <!-- form -->
            <form method="POST" action="{{ route('eventmie.register') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">@lang('eventmie::em.name')</label>
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                        name="name" value="{{ old('name') }}" required autofocus placeholder="@lang('eventmie::em.name')">
                </div>

                <!-- email -->
                <div class="mb-3">
                    <label for="email" class="form-label">@lang('eventmie::em.email_address')</label>
                    <input id="email" type="email"
                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                        value="{{ old('email') }}" required placeholder="@lang('eventmie::em.email')">

                </div>
                <!-- password -->
                <div class="mb-3">
                    <label for="password" class="form-label">@lang('eventmie::em.password')</label>
                    <input id="password" type="password"
                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required
                        placeholder="@lang('eventmie::em.password')">

                </div>


                <div class="mb-2">
                    <input class="form-check-input" type="checkbox" name="accept" id="accept" checked value="1"
                        hidden>
                    <p class="text-sm">
                        @lang('eventmie::em.accept_terms')
                    </p>
                </div>
                <!-- button -->

                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-door-open"></i>
                    @lang('eventmie::em.register')</button>

                <div class="d-flex justify-content-between mb-2 pb-2 mt-3 text-sm ">
                    <!-- form check -->
                    <div class="fw-bold">
                        <a href="{{ route('eventmie.password.request') }}" class="text-inherit">@lang('eventmie::em.forgot_password')</a>
                    </div>
                    <!-- forgot password -->
                    <div class="fw-bold">
                        <a href="{{ route('eventmie.login') }}" class="text-inherit"> @lang('eventmie::em.login')</a>
                    </div>
                </div>
            </form>



        </div>
    </div>

@endsection
