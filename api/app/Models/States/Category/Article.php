<?php

namespace App\Models\States\Category;

use App\Models\States\State;

class Article extends State
{
    public $label = [
          'fr' => 'Article',
          'en' => 'Article'
    ];

    public static $key = 'default';
}
