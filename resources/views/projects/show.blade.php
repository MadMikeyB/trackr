@extends('layouts.app')

@section('content')
<div class="sloped-section sloped-section--centered sloped-section--primary">
    <div class="sloped-section__container">
        <h1>Project: {{$project->title}}</h1>
        <h2>Time Estimated: {{$project->time_estimated}}</h2>
        <div class="row">
            <div class="col-3">
                <i class="far fa-clock fa-3x"></i>
                <h3>Time Remaining: {{$project->percentage_remaining}}%</h3>
            </div>
            <div class="col-3">
                <i class="fas fa-clock fa-3x"></i>
                <h3>Time Taken: {{$project->percentage_taken}}%</h3>
            </div>
            <div class="col-3">
                <i class="fas fa-chart-line fa-3x"></i>
                @if ($project->completed_milestones > 0)
                <h3>Milestones: {{$project->completed_milestones}} / {{$project->milestones->count()}}</h3>
                @else 
                <h3>Milestones: {{$project->milestones->count()}}</h3>
                @endif
            </div>
            <div class="col-3">
                <i class="fas fa-money-check-alt fa-3x"></i>
                <h3>Value: {{number_format($project->total_cost_quoted)}}  {{$project->user->settings->currency}}</h3>
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
                @endunless
                <p>
                    <a href="" class="button button--block button--solid-primary">
                        Log Time
                    </a>
                </p>
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
                                <div class="u-pull-right">
{{--                                     <a href="{{route('milestones.edit', [$project, $milestone])}}" class="u-padding">
                                        <i class="fas fa-check"></i>
                                    </a> --}}
                                    <a href="{{route('milestones.edit', [$project, $milestone])}}" class="u-padding">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-milestone-{{$milestone->id}}').submit();" class="u-padding">
                                        <i class="fas fa-times"></i>
                                    </a>
                                    <form id="delete-milestone-{{$milestone->id}}" action="{{ route('milestones.destroy', [$project, $milestone]) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No milestones have been created!</p>
                @endunless
                <p>
                    <a href="{{route('milestones.create', $project)}}" class="button button--small button--secondary">
                        Create Milestone
                    </a>
                </p>
            </div>
            <!-- / Milestones -->
        </div>
        
    </div>
</div>
@endsection
