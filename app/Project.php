<?php

namespace App;

use App\TimeLog;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes, Sluggable;

    /* @var array $fillable The fields which are mass assignable */
    protected $fillable = ['title', 'description', 'user_id', 'total_seconds'];

    /* @var array $with The relationships which we'll always load */
    public $with = ['timelogs'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    /**
     * Set the route key name for the Project Model
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timelogs()
    {
        return $this->hasMany(TimeLog::class)->latest('created_at');
    }

    /**
     * A project can have many milestones
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function milestones()
    {
        return $this->hasMany(ProjectMilestone::class);
    }

    /**
     * A project belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Convert hours to seconds for database storage
     */
    public function setTotalSecondsAttribute($hours)
    {
        // if (env('APP_ENV') !== 'testing') {
            $this->attributes['total_seconds'] = $hours * 3600;
        // } else {
            // $this->attributes['total_seconds'] = $hours;
        // }
    }

    /**
     * Convert seconds back to hours for display
     *
     * @return float
     */
    public function getTotalSecondsAttribute($totalSeconds)
    {
        // if (env('APP_ENV') !== 'testing') {
            return $totalSeconds / 3600;
        // } else {
        //     return $totalSeconds;
        // }
    }

    /**
     * A project exposes how much time has been quoted
     *
     * @return string
     */
    public function getTimeEstimatedAttribute()
    {
        return timeDiffForHumans($this->getOriginal('total_seconds'));
    }

    /**
     * A project exposes how much time has been logged
     *
     * @return string
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
        $onePercent = $this->getOriginal('total_seconds') / 100;
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

    /**
     * A project exposes how many milestones were completed
     *
     * @return float
     */
    public function getCompletedMilestonesAttribute()
    {
        return $this->milestones()->whereNotNull('completed_at')->count();
    }

    /**
     * A project exposes how much it is worth
     *
     * @return float
     */
    public function getTotalCostQuotedAttribute()
    {
        $total = $this->user->settings->hourly_rate * floor($this->getOriginal('total_seconds') / 3600);
        return $total;
    }
}
