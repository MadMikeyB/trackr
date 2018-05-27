@extends('layouts.app')

@section('content')
<div class="sloped-section sloped-section--centered sloped-section--primary">
    <h1>Add a Milestone to {{$project->title}}</h1>
    <div class="row">
        <div class="col-3">&nbsp;</div>
        <div class="col-6">
            <h2>Milestones are a great way to track your progress versus your estimate.</h2>
        </div>
        <div class="col-3">&nbsp;</div>
    </div>
</div>

<div class="section">
    <div class="section__container">
        <form method="POST" class="form" action="{{ route('milestones.store', $project) }}">
            @csrf

            <div class="form__group">
                <label for="title" class="form__label">{{ __('Milestone Title') }}</label>
                <input id="title" type="text" class="form__input{{ $errors->has('title') ? ' form__input--has-errors' : '' }}" name="title" value="{{ old('title') }}" required>
                @if ($errors->has('title'))
                    <span class="form__errors">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="completed" {{ old('completed') ? 'checked' : '' }}> {{ __('Completed?') }}
                    </label>
                </div>
            </div>

            <div class="form__group form__submit">
                <button type="submit" class="button button--solid-primary">
                    {{ __('Save Milestone') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
