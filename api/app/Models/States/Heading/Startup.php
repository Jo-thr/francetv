<?php

namespace App\Models\States\Heading;

use App\Models\States\Heading\HeadingState;

class Startup extends HeadingState
{
    public $label = [
          'fr' => 'Start-ups',
          'en' => 'Startups'
    ];

    public $slug = [
          'fr' => 'startups',
          'en' => 'startups',
    ];

    public $order = 4;

    public static $key = 'startups';
}
