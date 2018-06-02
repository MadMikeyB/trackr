<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectMilestone extends Model
{
    use SoftDeletes;
    
    /* @var $fillable The fields which are mass assignable */
    protected $fillable = ['title', 'user_id', 'project_id', 'completed_at'];

    /* @var $dates The fields which are mutated to carbon instances */
    public $dates = ['completed_at'];

    /**
     * A milestone belongs to a project
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * A milestone belongs to a user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // belongsTo User
}
