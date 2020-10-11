<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Work::class, function (Faker $faker) {
    return [
        'title' => str_random(7),
        'slug' => str_random(15),
        'skill' => str_random(7),
        'excerpt' => str_random(7),
        'image' => $faker->imageUrl(100, 100),
        'body' => $faker->text(200),
        'active' => $faker->numberBetween(5, 10),
        'created_by' => $faker->numberBetween(1, 2),
    ];
});

