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

$factory->define(App\Models\Auth\User::class, function (Faker $faker) {
    static $password;

    return [
        'email'      => $faker->unique()->safeEmail,
        'password'   => $password ?: $password = bcrypt('password'),
        'first_name' => $faker->firstName(),
        'last_name'  => $faker->lastName,
        'created_by' => 'Migration',
        'updated_by' => 'Migration',
    ];
});
