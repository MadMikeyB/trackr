<?php

namespace App;

use App\Events\TimeLogSaved;
use Illuminate\Database\Eloquent\Model;

class TimeLog extends Model
{
    /* @var array $fillable The fields which are mass assignable */
    protected $fillable = ['project_id', 'user_id', 'number_of_seconds'];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saved' => TimeLogSaved::class
    ];

    public $appends = ['number_of_seconds_for_humans'];

    /**
     * A time log belongs to a project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * A time log belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the number of seconds for humans attribute
     *
     * @return string
     */
    public function getNumberOfSecondsForHumansAttribute()
    {
        return timeDiffForHumans($this->number_of_seconds);
    }
}
