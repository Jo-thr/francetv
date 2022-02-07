<?php

use App\Models\Layout;
use App\Models\MetaMedia;
use App\Models\Post;
use App\Models\Test;
use App\Models\Heading;

use App\Models\States\Heading\News;
use App\Models\States\Heading\Podcast;
use App\Models\States\Heading\Tutorial;
use App\Models\States\Heading\NarrativeResearch;
use App\Models\States\Heading\RnD;
use App\Models\States\Heading\Tech;
use App\Models\States\Heading\Startup;
use App\Models\States\Heading\Transformation;

use App\Models\States\LayoutType\Main;
use App\Models\States\LayoutType\Narrative;
use App\Models\States\LayoutType\Home;
use App\Models\States\LayoutType\MetaMedia as MetaMediaType;
use App\Models\States\LayoutType\Tests;

class SeedLayoutsForProd
{
    public static function make()
    {
        Layout::create([
            'name' => 'meta-media',
            'label' => 'Page Meta-Medias',
            'type' => MetaMediaType::$key,
            'background' => '#0023FF',
            'underline' => '#FF778B',
            'font_black' => false,
        ]);

        Layout::create([
            'name' => 'home',
            'label' => 'Page d\'accueil',
            'type' => Home::$key,
            'background' => '#7DFFCE',
            'underline' => '#FFFFFF',
            'font_black' => true,
        ]);

        Layout::create([
            'name' => 'tests',
            'label' => 'Page Tests',
            'type' => Tests::$key,
            'background' => '#FF778B',
            'underline' => '#FFFFFF',
            'font_black' => true,
      ]);

        Layout::create([
            'name' => 'news',
            'label' => 'Informations',
            'type' => Main::$key,
            'background' => '#7DFFCE',
            'underline' => '#FFFFFF',
            'font_black' => true,
        ]);

        Layout::create([
            'name' => 'narrative-research',
            'label' => 'StoryLab',
            'type' => Narrative::$key,
            'background' => '#7DFFCE',
            'underline' => '#FFFFFF',
            'font_black' => true,
        ]);

        Layout::create([
            'name' => 'podcasts',
            'label' => 'Podcasts',
            'type' => Main::$key,
            'background' => '#7DFFCE',
            'underline' => '#FFFFFF',
            'font_black' => true,
        ]);

        Layout::create([
            'name' => 'startups',
            'label' => 'Start-Ups',
            'type' => Main::$key,
            'background' => '#7DFFCE',
            'underline' => '#FFFFFF',
            'font_black' => true,
        ]);

        Layout::create([
            'name' => 'transformation',
            'label' => 'Transformation',
            'type' => Main::$key,
            'background' => '#7DFFCE',
            'underline' => '#FFFFFF',
            'font_black' => true,
        ]);

        Layout::create([
            'name' => 'tutorials',
            'label' => 'Tutoriels',
            'type' => Main::$key,
            'background' => '#7DFFCE',
            'underline' => '#FFFFFF',
            'font_black' => true,
        ]);

        Layout::create([
            'name' => 'r-and-d',
            'label' => 'R&D',
            'type' => Main::$key,
            'background' => '#7DFFCE',
            'underline' => '#FFFFFF',
            'font_black' => true,
        ]);

        Layout::create([
            'name' => 'tech',
            'label' => 'Tech',
            'type' => Main::$key,
            'background' => '#7DFFCE',
            'underline' => '#FFFFFF',
            'font_black' => true,
        ]);
    }
}
