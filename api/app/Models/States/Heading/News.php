<?php

namespace App\Models\States\Heading;

use App\Models\States\Heading\HeadingState;

class News extends HeadingState
{
    public $label = [
          'fr' => 'Info',
          'en' => 'News'
    ];

    public $slug = [
          'fr' => 'info',
          'en' => 'news',
    ];

    public $order = 0;

    public static $key = 'info';
}
