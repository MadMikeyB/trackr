<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'user_id', 'total_seconds'];

    public function url()
    {
        return route('projects.show', $this);
    }
}
