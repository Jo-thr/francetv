<?php

namespace App\Models;

use App\Models\States\Heading\News;
use App\Models\States\Heading\Podcast;
use App\Models\States\Heading\Tutorial;
use App\Models\States\Heading\NarrativeResearch;
use App\Models\States\Heading\Startup;
use App\Models\States\Heading\Transformation;
use App\Models\States\Heading\RnD;
use App\Models\States\Heading\Tech;

class Heading
{
    public static $states = [
        News::class,
        Podcast::class,
        Tutorial::class,
        NarrativeResearch::class,
        Startup::class,
        Transformation::class,
        RnD::class,
        Tech::class,
    ];

    public static function all()
    {
        $arr = [];
        foreach (self::$states as $state) {
            $obj = new $state;
            $arr[(int) $obj->order] = $obj;
        }
        ksort($arr);
        return collect($arr);
    }

    public static function toArray()
    {
        $selectArray = [];

        foreach (static::$states as $class) {
            $obj = new $class();
            $selectArray[$class::$key] = $obj->label('fr');
        }
        return $selectArray;
    }

    public static function byKey(string $key): ?string
    {
        $arr = self::toArray();

        return isset($arr[$key]) ? $arr[$key] : null;
    }

    public static function getClass(?string $key)
    {
        $selectArray = [];

        foreach (static::$states as $class) {
            if($class::$key === $key) return $class;
        }
    }

    public static function bySlug(string $slug, string $lang): ?object
    {
        foreach (self::all() as $heading) {
            if ($slug === $heading->slug($lang)) {
                return $heading;
            }
        }
        return null;
    }
}
