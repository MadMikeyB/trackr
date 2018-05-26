<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSetting extends Model
{
    use SoftDeletes;
    
    /* @var $fillable The fields which are mass assignable in the database */
    protected $fillable = ['user_id', 'hourly_rate', 'currency'];
}
