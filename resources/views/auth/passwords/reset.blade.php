@extends('layouts.app')

@section('content')
<div class="sloped-section sloped-section--centered sloped-section--primary">
    <h1>You're just seconds away from your <span class="u-logo-text-darker">my<span>track</span>r</span>!</h1>
    <h2>Let's get you back home.</h2>
</div>

<div class="section">
    <div class="section__container">
        
        <form method="POST" class="form" action="{{ route('password.request') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form__group">
                <label for="email" class="form__label">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form__input{{ $errors->has('email') ? ' form__input--has-errors' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="form__error">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group">
                <label for="password" class="form__label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form__input{{ $errors->has('password') ? ' form__input--has-errors' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="form__error">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group">
                <label for="password-confirm" class="form__label">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form__input" name="password_confirmation" required>
            </div>

            <div class="form__group form__submit">
                <button type="submit" class="button button--block button--solid-primary">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
    </div>
</div>


@endsection
