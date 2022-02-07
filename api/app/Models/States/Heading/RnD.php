<?php

namespace App\Models\States\Heading;

use App\Models\States\Heading\HeadingState;

class RnD extends HeadingState
{
    public $label = [
          'fr' => 'R&D',
          'en' => 'R&D'
    ];

    public $slug = [
          'fr' => 'r-et-d',
          'en' => 'r-and-d',
    ];

    public $order = 2;

    public static $key = 'r-and-d';
}
