<?php

use App\Models\Test;
use App\Models\Vote;
use App\Models\Tag;

class SeedTests
{
    public static function make($nbTests = 20, $nbVotes = 400)
    {
        factory(Test::class, $nbTests)
        ->create()
        ->each(function ($test, $nbVotes) {
            $test
            ->tags()
            ->save(factory(Tag::class)
            ->make());
            $test
            ->votes()
            ->createMany(
                factory(Vote::class, $nbVotes)->make()->toArray()
            );
        });
    }
}
