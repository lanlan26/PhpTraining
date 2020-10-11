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

$factory->define(App\Models\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'slug' => $faker->word,
        'seo_title' => $faker->name,
        'excerpt' => $faker->word,
        'body' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'meta_description' => $faker->word,
        'keywords' => $faker->word,
        'active' => 1,
        'created_by' => 1,
    ];
});
