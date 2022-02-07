<?php

namespace App\Models\States\Type;

use App\Models\States\State;

class Test extends State
{
    public $label = [
          'fr' => 'à tester',
          'en' => 'to test'
    ];

    public static $key = 'test';
}
