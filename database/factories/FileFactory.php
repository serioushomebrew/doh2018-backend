<?php

use Faker\Generator as Faker;

$factory->define(\App\File::class, function (Faker $faker) {
    return [
        'name'        => $faker->word,
        'description' => $faker->realText(),
        'size'        => $faker->randomElement([
            '1.2 MB',
            '3.5 MB',
            '105 KB',
        ]),
    ];
});
