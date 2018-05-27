@extends('layouts.app')

@section('content')
<div class="sloped-section sloped-section--centered sloped-section--primary">
    <h1>Create your project on <span class="u-logo-text-darker">my<span>track</span>r</span></h1>
    <div class="row">
        <div class="col-3">&nbsp;</div>
        <div class="col-6">
            <h2>Once your project is created, you can log time against it, add milestones, and see how much time you have left.</h2>
        </div>
        <div class="col-3">&nbsp;</div>
    </div>
</div>

<div class="section">
    <div class="section__container">
        <form method="POST" class="form" action="{{ route('projects.store') }}">
            @csrf

            <div class="form__group">
                <label for="title" class="form__label">{{ __('Project Title') }}</label>
                <input id="title" type="text" class="form__input{{ $errors->has('title') ? ' form__input--has-errors' : '' }}" name="title" value="{{ old('title') }}" required>
                @if ($errors->has('title'))
                    <span class="form__errors">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group">
                <label for="description" class="form__label">{{ __('Project Description') }}</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form__input" required></textarea>

                @if ($errors->has('description'))
                    <span class="form__errors">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group">
                <label for="total_seconds" class="form__label">{{ __('Total Time Allocated') }}</label>
                <input id="total_seconds" type="text" class="form__input{{ $errors->has('total_seconds') ? ' form__input--has-errors' : '' }}" name="total_seconds" value="{{ old('total_seconds') }}" required>

                @if ($errors->has('total_seconds'))
                    <span class="form__errors">
                        <strong>{{ $errors->first('total_seconds') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group form__submit">
                <button type="submit" class="button button--solid-primary">
                    {{ __('Save Project') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
