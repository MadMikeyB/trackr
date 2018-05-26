<?php

namespace App;

use App\Events\TimeLogSaved;
use Illuminate\Database\Eloquent\Model;

class TimeLog extends Model
{
    /* @var $fillable The fields which are mass assignable */
    protected $fillable = ['project_id', 'user_id', 'number_of_seconds'];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saved' => TimeLogSaved::class
    ];

    /**
     * A time log belongs to a project
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * A time log belongs to a user
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}