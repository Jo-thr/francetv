<?php

namespace App\Models\States\Test;

use App\Models\States\State;

class Soon extends State
{
    public $label = [
          'fr' => 'Bientôt',
          'en' => 'Soon'
    ];

    public static $key = 'soon';
}
