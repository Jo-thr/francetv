<?php

namespace App\Models\States\LayoutType;

use App\Models\States\State;

class Tests extends State
{
    public $label = [
          'fr' => 'tests',
          'en' => 'Tests'
    ];

    public static $key = 'tests';
}
