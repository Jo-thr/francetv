<?php

namespace App\Models\States\Test;

use App\Models\States\State;

class OnPause extends State
{
    public $label = [
          'fr' => 'En pause',
          'en' => 'On pause'
    ];

    public static $key = 'onpause';
}
