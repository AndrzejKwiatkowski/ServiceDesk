<?php

use Faker\Generator as Faker;

$factory->define(App\Ticket::class, function (Faker $faker) {
    return [

        'title' => $faker->text(15),
        'body' => $faker->text(50),
    ];
});
