<?php

namespace App\Models\States\PublicationStatus;

use App\Models\States\State;

class Pending extends State
{
    public $label = [
          'fr' => 'Programmé',
          'en' => 'Schedulded'
    ];

    public static $key = 'pending';
}
