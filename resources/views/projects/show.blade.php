@extends('layouts.app')

@section('content')
<div class="sloped-section sloped-section--centered sloped-section--primary">
    <div class="sloped-section__container">
        <h1>
            Project: {{$project->title}} 
            <small>
                <a href="{{route('projects.edit', $project)}}">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="{{route('projects.destroy', $project)}}" onclick="event.preventDefault(); document.getElementById('delete-project-{{$project->id}}').submit();">
                    <i class="fas fa-times"></i>
                </a>
                <form id="delete-project-{{$project->id}}" action="{{ route('projects.destroy', $project) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </small>
        </h1>
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
        
        @if (auth()->user()->settings->hourly_rate == 0)
        <div class="alert alert--solid-secondary">
            <p>
                <i class="fas fa-info-circle"></i>
                You should set an hourly rate in your <a href="{{route('user.settings.index')}}">settings page</a> to take full advantage of <span class="u-logo-text u-logo-text-smaller">my<span>track</span>r</span>'s features
            </p>
        </div>
        @endif


        <div class="row">
            <div class="col-8">
                <h1><i class="fas fa-user-clock"></i> Time Logs</h1>
                <p>
                    <stopwatch :project="{{$project}}"></stopwatch>
                </p>
                @unless ($project->timelogs->isEmpty())
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
                    <a href="{{route('milestones.create', $project)}}" class="button button--block button--small button--solid-secondary">
                        Create Milestone
                    </a>
                </p>
            </div>
            <!-- / Milestones -->
        </div>
        
    </div>
</div>
@endsection
