<?php

use Faker\Generator as Faker;

$factory->define(\App\Skill::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
