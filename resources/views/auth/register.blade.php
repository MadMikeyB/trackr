@extends('layouts.app')

@section('content')
<div class="sloped-section sloped-section--centered sloped-section--primary">
    <h1>Sign Up For Free!</h1>
    <h2>All memberships are free whilst <span class="u-logo-text-darker">my<span>track</span>r</span> is in Early Access!</h2>
</div>

<div class="section">
    <div class="section__container">
        <form class="form" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form__group">
                <label for="name" class="form__label">{{ __('Name') }}</label>
                <input id="name" type="text" class="form__input {{ $errors->has('name') ? ' form__input--has-errors' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="form__errors">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group">
                <label for="email" class="form__label">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form__input{{ $errors->has('email') ? ' form__input--has-errors' : '' }}" name="email" value="{{ old('email') }}" required>

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
                <label for="password-confirm" class="form__label">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form__input" name="password_confirmation" required>
            </div>

            <div class="form__group">
                <div class="checkbox">
                    <p>The information we collect is solely to provide you with the services which you have requested of us and administer your account. Your information is not shared with any third parties.</p>
                    <label for="gdpr">
                        <input type="checkbox" id="gdpr" name="gdpr" required> I have read and agree to the <a href="{{route('static.privacy')}}">Privacy Policy</a> and <a href="{{route('static.terms')}}">Terms &amp; Conditions</a>
                    </label>
                </div>
            </div>

            <div class="form__group form__submit">
                <button type="submit" class="button button--solid-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
