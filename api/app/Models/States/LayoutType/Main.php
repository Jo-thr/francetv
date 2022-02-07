<?php

namespace App\Models\States\LayoutType;

use App\Models\States\State;

class Main extends State
{
    public $label = [
          'fr' => 'Principal',
          'en' => 'Main'
    ];

    public static $key = 'main';
}
