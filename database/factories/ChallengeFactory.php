<?php

use Faker\Generator as Faker;

$factory->define(\App\Challenge::class, function (Faker $faker) {
    return [
        'name'        => $faker->word,
        'description' => $faker->realText(),
        'level_id'    => function () {
            return factory(\App\Level::class)->create();
        },
    ];
});
