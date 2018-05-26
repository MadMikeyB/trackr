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
     * A project exposes how much time has been logged
     */
    public function getTimeLoggedAttribute()
    {
        return timeDiffForHumans($this->timelogs->sum('number_of_seconds'));
    }
}
