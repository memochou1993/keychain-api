<?php

use App\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->username,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$argon2i$v=19$m=1024,t=2,p=2$UThmSUxhMU12OVRwV3VaWg$OrU1Vlm51hSvU89zeCbiFTn0l335EcKBw5U6kQoE5No', // password
        'settings' => json_encode([
            'language' => 'en',
            'lock' => false,
            'strict' => false,
            'keep' => false,
            'keepDays' => 7,
            'paging' => 'loadMoreButton',
            'paginate' => 15,
            'theme' => '',
        ]),
    ];
});
