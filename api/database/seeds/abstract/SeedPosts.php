<?php

use App\Models\Post;
use App\Models\PostType;
use App\Models\Heading;
use App\Models\Tag;
use Faker\Factory as Faker;

class SeedPosts
{
    public static function make($nbPerHeading = 10)
    {
        foreach (Heading::all() as $heading) {
            factory(Post::class, $nbPerHeading)
            ->create([
              'heading' => $heading::$key,
              'type' => PostType::all()->shuffle()->first()::$key,
              'content_fr' => self::fakeContent(),
              'content_en' => self::fakeContent(),
            ])
            ->each(function ($user) {
                $user->tags()->save(factory(Tag::class)->make());
            });
        }
    }

    private static function fakeContent()
    {
        return "{\"time\": 1602167535550, \"blocks\": [{\"data\": {\"text\": \"Un titre \", \"level\": 2}, \"type\": \"header\"}, {\"data\": {\"text\": \"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"}, \"type\": \"paragraph\"}, {\"data\": {\"text\": \"Un autre titre\", \"level\": 2}, \"type\": \"header\"}, {\"data\": {\"html\": \"<iframe width=\\\"1257\\\" height=\\\"707\\\" src=\\\"https:\/\/www.youtube.com\/embed\/40ySIE_s6ps\\\" frameborder=\\\"0\\\" allow=\\\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\\\" allowfullscreen><\/iframe>\"}, \"type\": \"raw\"}], \"version\": \"2.18.0\"}";
    }
}
