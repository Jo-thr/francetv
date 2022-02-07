<?php

use App\Models\Pictogram;
use App\Models\Sponsor;

class SeedPictogramsAndSponsors
{
    public static function make()
    {
        foreach (self::getPictograms() as $data) {
            Pictogram::create($data);
        }

        foreach (self::getSponsors() as $data) {
            Sponsor::create($data);
        }
    }

    private static function getSponsors()
    {
        return [
      [
        'name' => 'sponsor 1',
        'logo' => 'sponsors/1.jpg',
      ],
      [
        'name' => 'sponsor 2',
        'logo' => 'sponsors/1.jpg',
      ],
      [
        'name' => 'sponsor 3',
        'logo' => 'sponsors/1.jpg',
      ],
    ];
    }

    private static function getPictograms()
    {
        return [
      [
        'title' => 'pictogram 1',
        'image' => 'pictograms/1.png',
      ],
      [
        'title' => 'pictogram 2',
        'image' => 'pictograms/1.png',
      ],
      [
        'title' => 'pictogram 3',
        'image' => 'pictograms/1.png',
      ],
    ];
    }
}
