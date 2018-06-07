<?php

use App\Team;
use Faker\Generator as Faker;

$factory->define(Team::class, function (Faker $faker) {
    $name = $faker->sentence;
    return [
        'name' => $name, 
        'slug' => str_slug($name), 
        'owner_id' => 0, 
        'active' => 1
    ];
});
