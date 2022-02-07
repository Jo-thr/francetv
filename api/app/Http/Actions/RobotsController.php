<?php

namespace App\Http\Actions;

use App\Http\Actions\Controller;
use MadWeb\Robots\Robots;

class RobotsController extends Controller
{
    /**
     * Generate robots.txt
     */
    public function __invoke(Robots $robots)
    {
        $robots->addUserAgent('*');

        if ($robots->shouldIndex()) {
            $robots->addAllow('/medias');
        }
        
        $robots->addDisallow('/');

        return response($robots->generate(), 200, ['Content-Type' => 'text/plain']);
    }
}