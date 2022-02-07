<?php

namespace App\Models\States\LayoutType;

use App\Models\States\State;

class Home extends State
{
    public $label = [
          'fr' => 'Accueil',
          'en' => 'Home'
    ];

    public static $key = 'home';
}
