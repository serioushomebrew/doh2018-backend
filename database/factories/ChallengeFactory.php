<?php

use Faker\Generator as Faker;

$factory->define(\App\Challenge::class, function (Faker $faker) {
    return [
        'user_id'     => function () {
            return factory(\App\User::class)->create();
        },
        'level_id'    => function () {
            return factory(\App\Level::class)->create();
        },
        'status'      => \App\Challenge::STATUS_OPEN,
        'name'        => $faker->word,
        'description' => $faker->realText(),
    ];
});
