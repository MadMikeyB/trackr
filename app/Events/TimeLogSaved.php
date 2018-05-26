<?php

namespace App\Events;

use App\TimeLog;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Notifications\ProjectIsAtFiftyPercentTime;
use App\Notifications\ProjectIsAtEightyPercentTime;
use App\Notifications\ProjectIsAtOneHundredPercentTime;

class TimeLogSaved
{
    use Dispatchable, SerializesModels;

    public $timelog;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(TimeLog $timelog)
    {
        $project = $timelog->project;

        // @todo only notify each user once, save spamming
        if ($project->percentage_taken >= 100) {
            $project->user->notify(new ProjectIsAtOneHundredPercentTime($project->user, $project));
        } elseif ($project->percentage_taken >= 80) {
            $project->user->notify(new ProjectIsAtEightyPercentTime($project->user, $project));
        } elseif ($project->percentage_taken >= 50) {
            $project->user->notify(new ProjectIsAtFiftyPercentTime($project->user, $project));
        }
    }
}
