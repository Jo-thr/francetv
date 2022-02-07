<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Post;

class ContentParser
{
    public static function parseForFeed(array $content): string
    {
    }

    public static function parseForTime($content)
    {
        $words = 0;
        $content = json_decode($content);

        foreach ($content->blocks as $bloc) {
            if ($bloc->type === "paragraph") {
                $words += self::parseContent(json_decode(json_encode($bloc), true));
            }
        }
        $timeToRead = ceil($words/100);

        return Carbon::createFromTime(0, $timeToRead, 0);
    }

    public static function parseForTimeV2($content)
    {
        $words = 0;
        $words += count(explode(' ', $content));
        $timeToRead = ceil($words/100);

        return Carbon::createFromTime(0, $timeToRead, 0);
    }

    public static function parseContent($bloc)
    {
        $words = 0;
        $words += count(explode(' ', $bloc['data']['text']));
        return $words;
    }

    public static function slugify($resource)
    {
        $slugFr = Str::of($resource->getTranslation('title', 'fr'))->slug('-');
        $slugEn = Str::of($resource->getTranslation('title', 'en'))->slug('-');

        $existing = Post::where('slug->fr', 'LIKE', "%{$slugFr}%")
        ->where('slug->en', 'LIKE', "%{$slugEn}%")
        ->orderBy('created_at', 'DESC')
        ->first();

        if ($existing) {
            $pos = strrpos($existing->slug, '-');
            $cpt = (int) substr($existing->slug, $pos+1);

            $cpt++;

            if ($cpt === 0) {
                $cpt++;
            }

            $slugFr .= '-'.$cpt;
            $slugEn .= '-'.$cpt;
        }

        $resource->setTranslation('slug', 'fr', (string) $slugFr);
        $resource->setTranslation('slug', 'en', (string) $slugEn);

        return $resource;
    }
}
