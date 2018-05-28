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
                        <a href="{{route('projects.show', $project)}}" title="{{$project->title}}" class="u-font-size-md">
                            <strong>{{$project->title}}</strong>
                        </a>
                        <div class="row">
                            <div class="col-2">
                                <small>
                                    Time Estimated: <strong>{{$project->time_estimated}}</strong>
                                </small> 
                            </div>
                            <div class="col-2">
                                <small>
                                    Time Used: <strong>{{$project->percentage_taken}}%</strong>
                                </small>
                            </div>
                            <div class="col-2">
                                <small>
                                    Time Remaining: <strong>{{$project->percentage_remaining}}% </strong>
                                </small>
                            </div>
                            <div class="col-2">
                                <small>
                                    Milestones: <strong>{{$project->milestones->count()}}</strong>
                                </small> 
                            </div>
                            <div class="col-2">
                                <small>
                                    Completed Milestones: <strong>{{$project->completed_milestones}}</strong>
                                </small> 
                            </div>
                            <div class="col-2">
                                <small>
                                    Value: <strong>{{number_format($project->total_cost_quoted)}}  {{$project->user->settings->currency}}</strong>
                                </small>
                            </div>
                        </div>
                    </li>
                @endforeach
            @else
                <div class="alert alert--solid-secondary">
                    <p>
                        <i class="fas fa-info-circle"></i>
                        Get started by clicking the <a href="{{route('projects.create')}}">Create Project</a> button.
                    </p>
                </div>
                <li>You don't seem to have any projects yet!</li>
            @endunless
        </ul>
    </div>
</div>

@endsection
