<?php

namespace App\Models\States\Heading;

use App\Models\States\Heading\HeadingState;

class NarrativeResearch extends HeadingState
{
    public $label = [
          'fr' => 'StoryLab',
          'en' => 'StoryLab'
    ];

    public $slug = [
          'fr' => 'recherche-narrative',
          'en' => 'narrative-research',
    ];

    public $order = 3;

    public static $key = 'recherche-narrative';
}
