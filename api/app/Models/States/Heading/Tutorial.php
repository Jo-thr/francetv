<?php

namespace App\Models\States\Heading;

use App\Models\States\Heading\HeadingState;

class Tutorial extends HeadingState
{
    public $label = [
          'fr' => 'Tutoriels',
          'en' => 'Tutorials'
    ];

    public $slug = [
          'fr' => 'tutos',
          'en' => 'tutorials',
    ];

    public $order = 6;

    public static $key = 'tutos';
}
