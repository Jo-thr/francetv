<?php

namespace App\Models\States\Category;

use App\Models\States\State;

class External extends State
{
    public $label = [
          'fr' => 'Article externe',
          'en' => 'External article'
    ];

    public static $key = 'external';
}
