<?php

namespace App\Models\States\Heading;

use App\Models\States\Heading\HeadingState;

class AllPosts extends HeadingState
{
    public $label = [
          'fr' => 'Tous les articles',
          'en' => 'All posts'
    ];

    public $slug = [
          'fr' => 'all-posts',
          'en' => 'all-posts',
    ];

    public static $key = 'all';
}
