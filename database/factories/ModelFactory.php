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
    return [
        'name' => $faker->name,
        'username' => $faker->firstName,
        'password' => bcrypt('EDI12'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Token::class, function (Faker\Generator $faker) {
    return [
        'SessionToken' => 'CD2F5616-70EE-4F8C-AC86-F0F5A2F409E2',
        'AuthenticationToken' => null,

    ];
});
