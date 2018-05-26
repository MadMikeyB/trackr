<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeLog extends Model
{
    /* @var $fillable The fields which are mass assignable */
    protected $fillable = ['project_id', 'user_id', 'number_of_seconds'];
}
