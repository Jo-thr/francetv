<?php

namespace App\Models\States\Heading;

use App\Models\States\Heading\HeadingState;

class Podcast extends HeadingState
{
    public $label = [
          'fr' => 'Podcasts',
          'en' => 'Podcasts'
    ];

    public $slug = [
          'fr' => 'podcasts',
          'en' => 'podcasts',
    ];

    public $order = 7;

    public static $key = 'podcasts';
}
