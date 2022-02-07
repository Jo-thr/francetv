<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MetaMedia;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(MetaMedia::class, function (Faker $faker) {
    return [
        'externalId' => $faker->unique()->randomNumber(),
        'title' => $faker->text($maxNbChars = 60),
        'url' => $faker->url,
        'image' => 'https://www.meta-media.fr/files/2020/08/illustration2.jpg',
        'description' => $faker->text($maxNbChars = 250),
        'sort_order' => 1,
        'published_at' => now(),
    ];
});
