<?php


namespace App\Helpers;

class NovaToolbox
{
    public static function query($request)
    {
        if (!isset($request->server()['HTTP_REFERER'])) {
            return false;
        }
        $novaUrl = $request->server()['HTTP_REFERER'];
        $parts = explode('?', $novaUrl);

        if (!isset($parts)) {
            return false;
        }

        if (!isset($parts[1])) {
            return [];
        }
        $queries = explode('&', $parts[1]);

        $arr = [];

        foreach ($queries as $query) {
            if (empty($query)) {
                continue;
            }
            $part = explode('=', $query);
            if (!isset($part[1])) {
                continue;
            }
            $arr[$part[0]] = $part[1];
        }
        return $arr;
    }

    public static function resourceId($request)
    {
        $novaUrl = $request->server()['HTTP_REFERER'];

        $parts = explode('/', $novaUrl);

        if (!isset($parts[6])) {
            return [];
        }

        return $parts[6];
    }
}
