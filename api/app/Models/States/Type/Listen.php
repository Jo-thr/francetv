<?php

namespace App\Models\States\Type;

use App\Models\States\State;

class Listen extends State
{
    public $label = [
          'fr' => 'à écouter',
          'en' => 'to listen'
    ];

    public static $key = 'listen';
}
