<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Token;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Token::class, function (Faker $faker) {
    return [
        'token' => Str::uuid(),
        'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
    ];
});
