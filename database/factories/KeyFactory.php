<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Crypt;

$factory->define(App\Key::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2),
        'content' => Crypt::encrypt($faker->word()),
        'user_id' => $faker->numberBetween(1, config('seeds.user.create')),
        'created_at'  => now()->subDays($faker->randomDigit()),
        'updated_at'  => now()->subDays($faker->randomDigit()),
    ];
});
