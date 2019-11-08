<?php

use Faker\Generator as Faker;


$factory->define(App\Ticket::class, function (Faker $faker) {
    $inputArray = [
        'Low',
        'Medium',
        'High'
    ];
    
    return [
        
        'title' => $faker->text(15),
        'body' => $faker->text(200),
        'priorytet' => implode(Arr::random($inputArray, 1)),
        'status' => 'open',
        'user_id' => rand(1,3)

        
    ];
});
