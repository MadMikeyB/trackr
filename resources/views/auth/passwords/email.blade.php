@extends('layouts.app')

@section('content')
<div class="sloped-section sloped-section--centered sloped-section--primary">
    <h1>Can't get into your <span class="u-logo-text-darker">my<span>track</span>r</span>?</h1>
    <h2>Letters? Numbers? Symbols? Let's just start again.</h2>
</div>

<div class="section">
    <div class="section__container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            
            <div class="form__group">
                <label for="email" class="form__label">{{ __('E-Mail Address') }}</label>

                <input id="email" type="email" class="form__input{{ $errors->has('email') ? ' form__input--has-errors' : '' }}" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="form__error">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group form__submit">
                <button type="submit" class="button button--block button--solid-primary">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
</div>
        

@endsection
