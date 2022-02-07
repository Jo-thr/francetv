<?php

namespace App\Models\States;

class StateHelper
{
    /**
     * Return array with key and label, for nova
     */
    public static function stateToArray($states): array
    {
        $selectArray = [];

        foreach ($states as $class) {
            $obj = new $class();
            $selectArray[$class::$key] = $obj->label('fr');
        }
        return $selectArray;
    }

    /**
     * Return array with label and key, for nova filters
     */
    public static function stateToArrayInverse($states): array
    {
        $selectArray = [];

        foreach ($states as $class) {
            $obj = new $class();
            $selectArray[$obj->label('fr')] = $class::$key;
        }
        return $selectArray;
    }

    public static function byKey(?string $key, array $states): ?string
    {
        $arr = self::stateToArray($states);

        return $arr[$key] ?? null;
    }
}
