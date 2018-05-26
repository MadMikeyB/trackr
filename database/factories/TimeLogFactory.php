<?php

use App\TimeLog;
use Faker\Generator as Faker;

$factory->define(TimeLog::class, function (Faker $faker) {
    return [
        'project_id' => 0,
        'user_id' => 0,
        'number_of_seconds' => 60
    ];
});
