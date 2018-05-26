<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    /* @var $fillable The fields which are mass assignable in the database */
    protected $fillable = ['user_id', 'hourly_rate', 'currency'];
}
