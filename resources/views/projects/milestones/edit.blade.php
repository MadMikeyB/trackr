@extends('layouts.app')

@section('content')
<div class="sloped-section sloped-section--centered sloped-section--primary">
    <h1>Edit Milestone &quot;{{$milestone->title}}&quot; on {{$project->title}}</h1>
    <div class="row">
        <div class="col-3">&nbsp;</div>
        <div class="col-6">
            <h2>Here you can change the title of your milestone, or mark it as completed.</h2>
        </div>
        <div class="col-3">&nbsp;</div>
    </div>
</div>

<div class="section">
    <div class="section__container">
        <form method="POST" class="form" action="{{ route('milestones.update', [$project, $milestone]) }}">
            @csrf
            @method('PATCH')

            <div class="form__group">
                <label for="title" class="form__label">{{ __('Milestone Title') }}</label>
                <input id="title" type="text" class="form__input{{ $errors->has('title') ? ' form__input--has-errors' : '' }}" name="title" value="{{ old('title') ?? $milestone->title }}" required>
                @if ($errors->has('title'))
                    <span class="form__errors">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="completed" {{ !is_null($milestone->completed_at) ? 'checked' : '' }}> {{ __('Completed?') }}
                    </label>
                </div>
            </div>

            <div class="form__group form__submit">
                <button type="submit" class="button button--solid-primary">
                    {{ __('Update Milestone') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
