@extends('layouts.app-slim')

@section('content')
<div class="section section--slim">
    <h1>
        <i class="fas fa-user-clock"></i> 
        Time Logs for {{$project->title}}
    </h1>
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
    <time-log-list minimal="true" :project="{{$project}}"></time-log-list>
</div>
@endsection
