<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use App\Models\User;
use App\Models\Pictogram;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => [
          'en' => $faker->text($maxNbChars = 60),
          'fr' => $faker->text($maxNbChars = 60),
        ],
        'slug' => [
          'en' => $faker->slug,
          'fr' => $faker->slug,
        ],
        'published' => $faker->boolean(),
        'category' => $faker->randomElement(['external','default','contribution']),
        'heading' => 'to_fill',
        'featured' => 'featured.png',
        'pictogram_id' => Pictogram::inRandomOrder()->first()->id,
        'type' => 'to_fill',
        'user_id' => User::inRandomOrder()->first()->id,
        'published_at' => now(),
    ];
});
