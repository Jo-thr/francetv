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

use Faker\Factory as Faker;

class SeedLayouts
{
    public static function make()
    {
        $faker = Faker::create();

        Layout::create([
            'name' => 'meta-media',
            'label' => 'Page Meta-Medias',
            'block1_id' => MetaMedia::inRandomOrder()->first()->id,
            'block1_type' => MetaMedia::class,
            'block1img' => 'test.jpg',
            'block1title' => [
                'fr' => $faker->text($maxNbChars = 30),
                'en' => $faker->text($maxNbChars = 30),
            ],
            'block1imgalt' => [
                'fr' => $faker->text($maxNbChars = 30),
                'en' => $faker->text($maxNbChars = 30),
            ],
            'description' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'type' => MetaMediaType::$key,
            'background' => '#0023FF',
            'underline' => '#FF778B',
            'font_black' => false,
            'block2_id' => MetaMedia::inRandomOrder()->first()->id,
            'block2_type' => MetaMedia::class,
            'block3_id' => MetaMedia::inRandomOrder()->first()->id,
            'block3_type' => MetaMedia::class,
        ]);

        Layout::create([
            'name' => 'home',
            'label' => 'Page d\'accueil',
            'block1_id' => Post::inRandomOrder()->first()->id,
            'block1_type' => Post::class,
            'block1img' => 'test.jpg',
            'block1title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'block1imgalt' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'description' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'type' => Home::$key,
            'background' => '#7DFFCE',
            'underline' => '#FFFFFF',
            'font_black' => true,
            'block2_id' => Post::inRandomOrder()->first()->id,
            'block2_type' => Post::class,
            'block3_id' => Post::inRandomOrder()->first()->id,
            'block3_type' => Post::class,
        ]);

        Layout::create([
            'name' => 'tests',
            'description' => [
                'fr' => 'Tests en français',
                'en' => 'Tests in english',
            ],
            'type' => Tests::$key,
            'label' => 'Page Tests',
            'block1_id' => Test::inRandomOrder()->first()->id,

            'block1_type' => Test::class,
            'block1img' => 'test.jpg',
            'block1title' => [
                'fr' => $faker->text($maxNbChars = 30),
                'en' => $faker->text($maxNbChars = 30),
            ],
            'block1imgalt' => [
              'fr' => $faker->text($maxNbChars = 30),
              'en' => $faker->text($maxNbChars = 30),
            ],
            'description' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'background' => '#FF778B',
            'underline' => '#FFFFFF',
            'font_black' => true,
            'block2_id' => Post::inRandomOrder()
            ->first()
            ->id,
            'block2_type' => Post::class,
            'block3_id' => Test::inRandomOrder()->first()->id,
            'block3_type' => Test::class,
      ]);

        Layout::create([
            'name' => 'news',
            'label' => 'Informations',
            'block1_id' => Post::where('heading', News::$key)->inRandomOrder()->first()->id,
            'block1_type' => Post::class,
            'block1img' => 'test.jpg',
            'block1title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'block1imgalt' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'description' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'type' => Main::$key,
            'background' => '#7DFFCE',
            'underline' => '#FFFFFF',
            'font_black' => true,
            'block2_id' => Post::where('heading', News::$key)->inRandomOrder()->first()->id,
            'block2_type' => Post::class,
            'block3_id' => Post::where('heading', News::$key)->inRandomOrder()->first()->id,
            'block3_type' => Post::class,
        ]);

        Layout::create([
            'name' => 'narrative-research',
            'label' => 'StoryLab',
            'block1_id' => Post::where('heading', NarrativeResearch::$key)->inRandomOrder()->first()->id,
            'block1_type' => Post::class,
            'block1img' => 'test.jpg',
            'block1title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'block1imgalt' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'description' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'type' => Narrative::$key,
            'background' => '#7DFFCE',
            'underline' => '#FFFFFF',
            'font_black' => true,
            'block2_id' => Post::where('heading', NarrativeResearch::$key)->inRandomOrder()->first()->id,
            'block2_type' => Post::class,
            'block3_id' => Post::where('heading', NarrativeResearch::$key)->inRandomOrder()->first()->id,
            'block3_type' => Post::class,
            'subtitle' => '{"time": 1629731234942, "blocks": [{"data": {"text": "Bienvenue dans la home de Storylab"}, "type": "paragraph"}], "version": "2.18.0"}',
            'shortcut' => '["/recherche?query=documentaires", "/recherche?query=AR", "/recherche?query=Les%20prim%C3%A9s"]',
            'coProdTitle' => [
                'fr' => $faker->text($maxNbChars = 85),
                'en' => $faker->text($maxNbChars = 85),
            ],
            'coProdSubTitle' => [
                'fr' => $faker->text($maxNbChars = 200),
                'en' => $faker->text($maxNbChars = 200),
            ],
            'agendaTitle' => [
                'fr' => $faker->text($maxNbChars = 85),
                'en' => $faker->text($maxNbChars = 85),
            ],
            'agendaSubTitle' => [
                'fr' => $faker->text($maxNbChars = 200),
                'en' => $faker->text($maxNbChars = 200),
            ],
            'participateTitle' => [
                'fr' => $faker->text($maxNbChars = 85),
                'en' => $faker->text($maxNbChars = 85),
            ],
            'participateSubTitle' => [
                'fr' => $faker->text($maxNbChars = 200),
                'en' => $faker->text($maxNbChars = 200),
            ],
            'participate_insert1_id' => Post::where('heading', NarrativeResearch::$key)->inRandomOrder()->first()->id,
            'participate_insert1_type' => Post::class,
            'participate_insert1_Description' => [
                'fr' => $faker->text($maxNbChars = 350),
                'en' => $faker->text($maxNbChars = 350),
            ],
            'participate_insert1_Button' => [
                'fr' => $faker->text($maxNbChars = 25),
                'en' => $faker->text($maxNbChars = 25),
            ],
            'participate_insert2_id' => Post::where('heading', NarrativeResearch::$key)->inRandomOrder()->first()->id,
            'participate_insert2_type' => Post::class,
            'participate_insert2_Description' => [
                'fr' => $faker->text($maxNbChars = 350),
                'en' => $faker->text($maxNbChars = 350),
            ],
            'participate_insert2_Button' => [
                'fr' => $faker->text($maxNbChars = 25),
                'en' => $faker->text($maxNbChars = 25),
            ],
            'participate_insert3_id' => Post::where('heading', NarrativeResearch::$key)->inRandomOrder()->first()->id,
            'participate_insert3_type' => Post::class,
            'participate_insert3_Description' => [
                'fr' => $faker->text($maxNbChars = 350),
                'en' => $faker->text($maxNbChars = 350),
            ],
            'participate_insert3_Button' => [
                'fr' => $faker->text($maxNbChars = 25),
                'en' => $faker->text($maxNbChars = 25),
            ],
            'archiveTitle' => [
                'fr' => $faker->text($maxNbChars = 85),
                'en' => $faker->text($maxNbChars = 85),
            ],
            'archiveSubTitle' => [
                'fr' => $faker->text($maxNbChars = 200),
                'en' => $faker->text($maxNbChars = 200),
            ],
        ]);

        Layout::create([
            'name' => 'podcasts',
            'label' => 'Podcasts',
            'block1_id' => Post::where('heading', Podcast::$key)->inRandomOrder()->first()->id,
            'block1_type' => Post::class,
            'block1img' => 'test.jpg',
            'block1title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'block1imgalt' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'description' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'type' => Main::$key,
            'background' => '#7DFFCE',
            'underline' => '#FFFFFF',
            'font_black' => true,
            'block2_id' => Post::where('heading', Podcast::$key)->inRandomOrder()->first()->id,
            'block2_type' => Post::class,
            'block3_id' => Post::where('heading', Podcast::$key)->inRandomOrder()->first()->id,
            'block3_type' => Post::class,
        ]);

        Layout::create([
            'name' => 'startups',
            'label' => 'Start-Ups',
            'block1_id' => Post::where('heading', Startup::$key)->inRandomOrder()->first()->id,
            'block1_type' => Post::class,
            'block1img' => 'test.jpg',
            'block1title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'block1imgalt' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'description' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'type' => Main::$key,
            'background' => '#7DFFCE',
            'underline' => '#FFFFFF',
            'font_black' => true,
            'block2_id' => Post::where('heading', Startup::$key)->inRandomOrder()->first()->id,
            'block2_type' => Post::class,
            'block3_id' => Post::where('heading', Startup::$key)->inRandomOrder()->first()->id,
            'block3_type' => Post::class,
        ]);

        Layout::create([
            'name' => 'transformation',
            'label' => 'Transformation',
            'block1_id' => Post::where('heading', Transformation::$key)->inRandomOrder()->first()->id,
            'block1_type' => Post::class,
            'block1img' => 'test.jpg',
            'block1title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'block1imgalt' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'description' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'type' => Main::$key,
            'background' => '#7DFFCE',
            'underline' => '#FFFFFF',
            'font_black' => true,
            'block2_id' => Post::where('heading', Transformation::$key)->inRandomOrder()->first()->id,
            'block2_type' => Post::class,
            'block3_id' => Post::where('heading', Transformation::$key)->inRandomOrder()->first()->id,
            'block3_type' => Post::class,
        ]);

        Layout::create([
            'name' => 'tutorials',
            'label' => 'Tutoriels',
            'block1_id' => Post::where('heading', Tutorial::$key)
            ->inRandomOrder()
            ->first()
            ->id,
            'block1_type' => Post::class,
            'block1img' => 'test.jpg',
            'block1title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'block1imgalt' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'description' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'type' => Main::$key,
            'background' => '#7DFFCE',
            'underline' => '#FFFFFF',
            'font_black' => true,
            'block2_id' => Post::where('heading', Tutorial::$key)
            ->inRandomOrder()
            ->first()
            ->id,
            'block2_type' => Post::class,
            'block3_id' => Post::where('heading', Tutorial::$key)
            ->inRandomOrder()
            ->first()
            ->id,
            'block3_type' => Post::class,
        ]);

        Layout::create([
            'name' => 'r-and-d',
            'label' => 'R&D',
            'block1_id' => Post::where('heading', RnD::$key)
            ->inRandomOrder()
            ->first()
            ->id,
            'block1_type' => Post::class,
            'block1img' => 'test.jpg',
            'block1title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'block1imgalt' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'description' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'type' => Main::$key,
            'background' => '#7DFFCE',
            'underline' => '#FFFFFF',
            'font_black' => true,
            'block2_id' => Post::where('heading', RnD::$key)
            ->inRandomOrder()
            ->first()
            ->id,
            'block2_type' => Post::class,
            'block3_id' => Post::where('heading', RnD::$key)
            ->inRandomOrder()
            ->first()
            ->id,
            'block3_type' => Post::class,
        ]);

        Layout::create([
            'name' => 'tech',
            'label' => 'Tech',
            'block1_id' => Post::where('heading', Tech::$key)
            ->inRandomOrder()
            ->first()
            ->id,
            'block1_type' => Post::class,
            'block1img' => 'test.jpg',
            'block1title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'block1imgalt' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'description' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'title' => [
                'en' => $faker->text($maxNbChars = 30),
                'fr' => $faker->text($maxNbChars = 30),
            ],
            'type' => Main::$key,
            'background' => '#7DFFCE',
            'underline' => '#FFFFFF',
            'font_black' => true,
            'block2_id' => Post::where('heading', Tech::$key)
            ->inRandomOrder()
            ->first()
            ->id,
            'block2_type' => Post::class,
            'block3_id' => Post::where('heading', Tech::$key)
            ->inRandomOrder()
            ->first()
            ->id,
            'block3_type' => Post::class,
        ]);
    }
}
