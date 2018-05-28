<?php

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'title' => $title,
        'slug' => str_slug($title),
        'description' => $faker->paragraph,
        'user_id' => 0,
        'total_seconds' => 28800
    ];
});
