<?php

namespace App\Models\States\Type;

use App\Models\States\State;

class Read extends State
{
    public $label = [
          'fr' => 'à lire',
          'en' => 'to read'
    ];

    public static $key = 'read';
}
