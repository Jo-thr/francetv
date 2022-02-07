<?php

namespace App\Models\States\LayoutType;

use App\Models\States\State;

class Narrative extends State
{
    public $label = [
          'fr' => 'StoryLab',
          'en' => 'StoryLab'
    ];

    public static $key = 'narrative';
}
