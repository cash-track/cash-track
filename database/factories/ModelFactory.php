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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'password'       => bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Balance::class, function (Faker\Generator $faker) {
    return [
        'amount'        => $faker->randomDigit + 1 * 1000,
        'is_active'     => $faker->boolean,
    ];
});

$factory->define(App\Models\Trans::class, function (Faker\Generator $faker) {
    return [
        'amount'        => $faker->randomDigit * 1000,
        'balance_id'    => function () {
            $balance_id = App\Models\Balance::all();

            return $balance_id->get(random_int(0, $balance_id->count() - 1))->id;
        },
    ];
});
