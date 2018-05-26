<?php

use App\UserSetting;
use Faker\Generator as Faker;

$factory->define(UserSetting::class, function (Faker $faker) {
    return [
        'user_id' => 0,
        'hourly_rate' => 0,
        'currency' => 'GBP'
    ];
});
