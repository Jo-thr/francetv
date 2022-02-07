<?php

namespace App\Models\States\Category;

use App\Models\States\State;

class Contribution extends State
{
    public $label = [
          'fr' => 'Appel à contribution',
          'en' => 'Contribution'
    ];

    public static $key = 'contribution';
}
