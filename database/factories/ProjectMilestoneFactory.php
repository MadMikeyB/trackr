<?php

use App\ProjectMilestone;
use Faker\Generator as Faker;

$factory->define(ProjectMilestone::class, function (Faker $faker) {
    return [
        'project_id' => 0, 
        'user_id' => 0, 
        'title' => $faker->sentence, 
        'completed_at' => null
    ];
});
