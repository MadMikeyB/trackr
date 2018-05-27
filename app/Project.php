<?php

namespace App;

use App\TimeLog;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    /* @var $fillable The fields which are mass assignable */
    protected $fillable = ['title', 'description', 'user_id', 'total_seconds'];

    /* @var $with The relationships which we'll always load */
    public $with = ['timelogs'];

    /**
     * A project exposes it's URL
     * 
     * @return string
     */
    public function url()
    {
        return route('projects.show', $this);
    }

    /**
     * A project can have many timelogs
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timelogs()
    {
        return $this->hasMany(TimeLog::class);
    }

    /**
     * A project can have many milestones
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function milestones()
    {
        return $this->hasMany(ProjectMilestone::class);
    }

    /**
     * A project belongs to a user
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A project exposes how much time has been logged
     */
    public function getTimeLoggedAttribute()
    {
        return timeDiffForHumans($this->timelogs->sum('number_of_seconds'));
    }

    /**
     * A project exposes how much time has been logged (seconds)
     * 
     * @return int
     */
    public function getTimeLoggedSecondsAttribute()
    {
        return $this->timelogs->sum('number_of_seconds');
    }

    /**
     * A project exposes how much of the percentage of time has been logged
     * 
     * @return float
     */
    public function getPercentageTakenAttribute()
    {
        $onePercent = $this->total_seconds / 100;
        $percentage = min(100, ceil($this->time_logged_seconds / $onePercent));

        return $percentage;
    }

    /**
     * A project exposes how much of the percentage of time has been logged
     * 
     * @return float
     */
    public function getPercentageRemainingAttribute()
    {
        return (100 - $this->percentage_taken);
    }

    public function getCompletedMilestonesAttribute()
    {
        return $this->milestones()->whereNotNull('completed_at')->count();
    }
}
