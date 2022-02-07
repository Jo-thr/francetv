<?php

use App\Models\MetaMedia;

class SeedMetaMedia
{
    public static function make($nb = 50)
    {
        factory(MetaMedia::class, $nb)->create();
    }
}
