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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'user_status_id' => App\UserStatus::all()->random()->id
    ];
});

$factory->define(App\UserStatus::class, function (Faker\Generator $faker) {
    $name = $faker->unique()->word;

    return [
        'name' => $name,
        'slug' => str_slug($name, '-'),
    ];
});
