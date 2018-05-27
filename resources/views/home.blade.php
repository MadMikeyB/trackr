@extends('layouts.app')

@section('content')
<div class="sloped-section sloped-section--centered sloped-section--primary">
    <h1>Your <span class="u-logo-text-darker">my<span>track</span>r</span> Dashboard</h1>
    <h3>Here is where you can access all of your projects to log time, create milestones etc.</h3>
    <a href="{{route('projects.create')}}" class="button button--solid-secondary">Create a New Project</a>
</div>

<div class="section">
    <div class="section__container">
        <h1>Your Projects</h1>
        <ul class="list-group">
            @unless($projects->isEmpty())
                @foreach ($projects as $project)
                    <li class="list-group__item">
                        <i class="fas fa-project-diagram"></i>
                        <a href="{{route('projects.show', $project)}}" title="{{$project->title}}">
                            {{$project->title}}
                        </a>
                    </li>
                @endforeach
            @else
                <li>You don't seem to have any projects yet!</li>
            @endunless
        </ul>
    </div>
</div>

@endsection
