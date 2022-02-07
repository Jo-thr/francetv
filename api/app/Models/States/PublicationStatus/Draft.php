<?php

namespace App\Models\States\PublicationStatus;

use App\Models\States\State;

class Draft extends State
{
    public $label = [
          'fr' => 'Brouillon',
          'en' => 'Draft'
    ];

    public static $key = 'draft';
}
