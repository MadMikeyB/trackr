<?php

namespace App;

use App\Events\UserSaved;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saved' => UserSaved::class
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * A user has many projects
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * A user has many timelogs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timelogs()
    {
        return $this->hasMany(TimeLog::class);
    }

    /**
     * A user has many settings
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings()
    {
        return $this->hasOne(UserSetting::class);
    }

    /**
     * A user has many milestones
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function milestones()
    {
        return $this->hasMany(ProjectMilestone::class);
    }

    /**
     * Get the total time logged for this user
     *
     * @return int
     */
    public function getTotalTimeLoggedAttribute()
    {
        return $this->timelogs->sum('number_of_seconds');
    }
}
