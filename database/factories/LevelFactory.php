<?php

use Faker\Generator as Faker;

$factory->define(\App\Level::class, function (Faker $faker) {
    return [
        'points'      => $faker->numberBetween(100, 100000),
        'name'        => 'Level' . $faker->numberBetween(1, 10),
        'description' => $faker->realText(),
    ];
});
