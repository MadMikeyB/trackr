@extends('layouts.app')

@section('content')
<div class="sloped-section sloped-section--centered sloped-section--primary">
    <h1>Editing Project: {{$project->title}}</h1>
</div>

<div class="section">
    <div class="section__container">
        <form method="POST" class="form" action="{{ route('projects.update', $project) }}">
            @csrf
            @method('PATCH')

            <div class="form__group">
                <label for="title" class="form__label">{{ __('Project Title') }}</label>
                <input id="title" type="text" class="form__input{{ $errors->has('title') ? ' form__input--has-errors' : '' }}" name="title" value="{{ old('title') ?? $project->title }}" required>
                @if ($errors->has('title'))
                    <span class="form__errors">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group">
                <label for="description" class="form__label">{{ __('Project Description') }}</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form__input" required>{{ old('description') ?? $project->description }}</textarea>

                @if ($errors->has('description'))
                    <span class="form__errors">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group">
                <label for="total_seconds" class="form__label">{{ __('Total Time Allocated') }}</label>
                <input id="total_seconds" type="text" class="form__input{{ $errors->has('total_seconds') ? ' form__input--has-errors' : '' }}" name="total_seconds" value="{{ old('total_seconds') ?? $project->total_seconds }}" required>

                @if ($errors->has('total_seconds'))
                    <span class="form__errors">
                        <strong>{{ $errors->first('total_seconds') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group form__submit">
                <button type="submit" class="button button--solid-primary">
                    {{ __('Update Project') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
