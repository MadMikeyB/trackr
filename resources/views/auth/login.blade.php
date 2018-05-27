@extends('layouts.app')

@section('content')
<div class="sloped-section sloped-section--centered sloped-section--primary">
    <h1>Log In to <span class="u-logo-text-darker">my<span>track</span>r</span></h1>
    <h2>Email, password, you know the drill.</h2>
</div>

<div class="section">
    <div class="section__container">
        <form method="POST" class="form" action="{{ route('login') }}">
            @csrf
            <div class="form__group">
                <label for="email" class="form__label">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form__input{{ $errors->has('email') ? ' form__input--has-errors' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="form__errors">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group">
                <label for="password" class="form__label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form__input{{ $errors->has('password') ? ' form__input--has-errors' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="form__errors">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                    </label>
                </div>
            </div>

            <div class="form__group form__submit">
                <button type="submit" class="button button--solid-primary">
                    {{ __('Login') }}
                </button>

                <a href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
