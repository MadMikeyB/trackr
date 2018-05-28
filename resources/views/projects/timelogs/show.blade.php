@extends('layouts.app-slim')

@section('content')
<div class="section section--slim">
    <h1>
        <i class="fas fa-user-clock"></i> 
        Time Logs for {{$project->title}}
    </h1>
    <p>
        <stopwatch :project="{{$project}}"></stopwatch>
    </p>
    @unless ($project->timelogs->isEmpty())
    <div class="row">
        <div class="col-3">
            <small>
                Estimated: <strong>{{$project->time_estimated}}</strong>
            </small> 
        </div>
        <div class="col-3">
            <small>
                Time: <strong>{{$project->percentage_taken}}% / {{$project->percentage_remaining}}%</strong>
            </small>
        </div>
        <div class="col-3">
            <small>
                Milestones: <strong>{{$project->completed_milestones}} / {{$project->milestones->count()}}</strong>
            </small> 
        </div>
        <div class="col-3">
            <small>
                Value: <strong>{{number_format($project->total_cost_quoted)}}  {{$project->user->settings->currency}}</strong>
            </small>
        </div>
    </div>
    <ul class="list-group">
        @foreach ($project->timelogs->sortByDesc('created_at') as $timelog)
            <li class="list-group__item">
                <i class="fas fa-clock"></i>
                {{timeDiffForHumans($timelog->number_of_seconds)}} on {{ $timelog->created_at->format('jS F Y \a\t H:i:s') }}
            </li>
        @endforeach
    </ul>
    @else
        <p>No time logs have been created!</p>
    @endunless
</div>
@endsection
