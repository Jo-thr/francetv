<?php

namespace App\Models\States\Type;

use App\Models\States\State;

class See extends State
{
    public $label = [
          'fr' => 'à voir',
          'en' => 'to watch'
    ];

    public static $key = 'see';
}
