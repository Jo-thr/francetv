<?php

namespace App\Models\States\Test;

use App\Models\States\State;

class Finished extends State
{
    public $label = [
          'fr' => 'Terminé',
          'en' => 'Finished'
    ];

    public static $key = 'finished';
}
