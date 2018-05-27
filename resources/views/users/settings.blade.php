@extends('layouts.app')

@section('content')
<div class="sloped-section sloped-section--centered sloped-section--primary">
    <h1>Your <span class="u-logo-text-darker">my<span>track</span>r</span> Settings</h1>
    <div class="row">
        <div class="col-3">&nbsp;</div>
        <div class="col-6">
            <h2>The heart of your account, set your hourly rate and currency here.</h2>
        </div>
        <div class="col-3">&nbsp;</div>
    </div>
</div>

<div class="section">
    <div class="section__container">
        <form method="POST" class="form" action="{{ route('user.settings.store') }}">
            @csrf

            <div class="form__group">
                <label for="hourly_rate" class="form__label">{{ __('Your Hourly Rate') }}</label>
                <input id="hourly_rate" type="text" class="form__input{{ $errors->has('hourly_rate') ? ' form__input--has-errors' : '' }}" name="hourly_rate" value="{{ old('hourly_rate') ?? auth()->user()->settings->hourly_rate }}" required>
                @if ($errors->has('hourly_rate'))
                    <span class="form__errors">
                        <strong>{{ $errors->first('hourly_rate') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group">
                <label for="currency" class="form__label">{{ __('Your Currency Code, e.g. GBP') }}</label>
                <input id="currency" type="text" class="form__input{{ $errors->has('currency') ? ' form__input--has-errors' : '' }}" name="currency" value="{{ old('currency') ?? auth()->user()->settings->currency }}" required>
                @if ($errors->has('currency'))
                    <span class="form__errors">
                        <strong>{{ $errors->first('currency') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group form__submit">
                <button type="submit" class="button button--solid-primary">
                    {{ __('Update Settings') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
