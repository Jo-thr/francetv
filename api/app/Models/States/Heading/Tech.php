<?php

namespace App\Models\States\Heading;

use App\Models\States\Heading\HeadingState;

class Tech extends HeadingState
{
    public $label = [
          'fr' => 'Tech',
          'en' => 'Tech'
    ];

    public $slug = [
          'fr' => 'tech',
          'en' => 'tech',
    ];

    public $order = 1;

    public static $key = 'tech';
}
