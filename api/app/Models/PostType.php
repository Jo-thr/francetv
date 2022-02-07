<?php

namespace App\Models;

use App\Models\States\Type\Read;
use App\Models\States\Type\See;
use App\Models\States\Type\Listen;
use App\Models\States\Type\Test;

class PostType
{
    public static $states = [
    Read::class,
    See::class,
    Listen::class,
    Test::class,
  ];

    public static function all()
    {
        $arr = [];
        foreach (self::$states as $state) {
            $arr[] = new $state;
        }

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
}
