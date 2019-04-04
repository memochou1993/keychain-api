<?php

use Faker\Generator as Faker;

$factory->define(App\Key::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'password' => '$argon2i$v=19$m=1024,t=2,p=2$UUxxaWZ1akM1dzlmbEtiNA$+Q2+IURHJIe0xYmLds0j3x59SeC+77W6/Qp9wR85jQY', // secret
        'created_at'  => now()->subDays($faker->randomDigit()),
        'updated_at'  => now()->subDays($faker->randomDigit()),
    ];
});
