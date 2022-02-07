<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Vote;
use App\Models\Token;
use Faker\Generator as Faker;

$factory->define(Vote::class, function (Faker $faker) {
    return [
        'note' => rand(1, 5),
        'token_id' => Token::inRandomOrder()->first()->id,
        'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
    ];
});
