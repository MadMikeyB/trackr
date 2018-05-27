@extends('layouts.app')

@section('content')
<div class="sloped-section sloped-section--centered sloped-section--primary">
    <div class="sloped-section__container">
        <h1>Project: {{$project->title}}</h1>
        <div class="row">
            <div class="col-4">
                <i class="far fa-clock fa-3x"></i>
                <h3>Time Remaining: {{$project->percentage_remaining}}%</h3>
            </div>
            <div class="col-4">
                <i class="fas fa-chart-line fa-3x"></i>
                <h3>Milestones: {{$project->milestones->count()}}</h3>
            </div>
            <div class="col-4">
                <i class="fas fa-clock fa-3x"></i>
                <h3>Time Taken: {{$project->percentage_taken}}%</h3>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="section__container">
        
        <div class="row">
            <div class="col-8">
                <h1><i class="fas fa-user-clock"></i> Time Logs</h1>
                @unless ($project->timelogs->isEmpty())
                <ul>
                    @foreach ($project->timelogs as $timelog)
                        <li>{{timeDiffForHumans($timelog->number_of_seconds)}} on {{ $timelog->created_at->format('j fS Y') }}</li>
                    @endforeach
                </ul>
                @else
                    <p>No time logs have been created!</p>
                    <p>
                        <a href="" class="button button--block button--solid-primary">
                            Log Time
                        </a>
                    </p>
                @endunless
            </div>
            <!-- Milestones -->
            <div class="col-4">
                <h1><i class="fas fa-chart-line"></i> Milestones</h1>
                @unless ($project->milestones->isEmpty())
                    <ul>
                        @foreach ($project->milestones as $milestone)
                            <li>
                                @if (!is_null($milestone->completed_at)) 
                                    <i class="fas fa-check"></i> 
                                @endif 
                                {{$milestone->title}}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No milestones have been created!</p>
                    <p>
                        <a href="{{route('milestones.create', $project)}}" class="button button--small button--secondary">
                            Create Milestone
                        </a>
                    </p>
                @endunless
            </div>
            <!-- / Milestones -->
        </div>
        
    </div>
</div>
@endsection
