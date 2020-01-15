<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\RealEstate::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'description' => $faker->text,
        'status_id' => $faker->numberBetween($min = 1, $max = 3),
        'kind_id' => $faker->numberBetween($min = 1, $max = 6),
        'operation_type_id' => $faker->numberBetween($min = 1, $max = 2),
        'min_price' => $faker->randomNumber(2),
        'max_price' => $faker->randomNumber(2)
    ];
});
