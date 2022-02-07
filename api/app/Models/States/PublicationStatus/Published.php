<?php

namespace App\Models\States\PublicationStatus;

use App\Models\States\State;

class Published extends State
{
    public $label = [
          'fr' => 'Publié',
          'en' => 'Published'
    ];

    public static $key = 'published';
}
