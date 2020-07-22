<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Recipe;
use App\User;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

    return [
        'name' => $faker->foodName(),
        'description' => $faker->text,
        'user_id' => User::first()->id,
        'view_count' => $faker->numberBetween(0, 1000),
        'cooking_time' => $faker->time('H:i:s', 'now'),

    ];
});
