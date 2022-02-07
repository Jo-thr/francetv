<?php

namespace App\Models\States\Heading;

use App\Models\States\Heading\HeadingState;

class Transformation extends HeadingState
{
    public $label = [
          'fr' => 'Transformation',
          'en' => 'Tranformation'
    ];

    public $slug = [
          'fr' => 'transformation',
          'en' => 'transformation',
    ];

    public $order = 5;

    public static $key = 'transformation';
}
