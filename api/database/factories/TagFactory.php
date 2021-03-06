<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tag;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'name' => [
          'en' => $faker->domainWord.$faker->domainWord,
          'fr' => $faker->domainWord.$faker->domainWord,
        ],
        'slug' => [
          'en' => $faker->domainWord.$faker->domainWord,
          'fr' => $faker->domainWord.$faker->domainWord
        ],
    ];
});
