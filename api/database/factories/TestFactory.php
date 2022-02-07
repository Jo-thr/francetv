<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Test;
use App\Models\Sponsor;
use Faker\Generator as Faker;

$factory->define(Test::class, function (Faker $faker) {
    return [
        'title' => [
          'fr' => $faker->text($maxNbChars = 60),
          'en' => $faker->text($maxNbChars = 60)
        ],
        'slug' => [
          'fr' => $faker->slug,
          'en' => $faker->slug,
        ],
        'sponsor_id' => Sponsor::inRandomOrder()->first()->id,
        'paused' => $faker->boolean,
        'share' => rand(0, 250),
        'start_at' => $faker->dateTimeBetween('-6 years', '- 3 months'),
        'end_at' => $faker->dateTimeBetween('- 3 months', '+ 3 months'),
    ];
});
