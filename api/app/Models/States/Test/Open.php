<?php

namespace App\Models\States\Test;

use App\Models\States\State;

class Open extends State
{
    public $label = [
          'fr' => 'En cours',
          'en' => 'Open'
    ];

    public static $key = 'open';
}
