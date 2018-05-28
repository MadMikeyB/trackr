<?php

namespace App\Events;

use App\User;
use App\UserSetting;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class UserSaved
{
    use Dispatchable, SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        UserSetting::firstOrCreate([
           'user_id' => $user->id,
           'hourly_rate' => 0,
           'currency' => 'GBP',
        ]);
    }
}
