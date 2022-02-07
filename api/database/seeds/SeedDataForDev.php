<?php

use Illuminate\Database\Seeder;

class SeedDataForDev extends Seeder
{
    public function run()
    {
        SeedDepartements::make();
        SeedPictogramsAndSponsors::make();
        SeedUsers::make(50, rand(100, 400));
        SeedMetaMedia::make(50);
        SeedTests::make(60, rand(100, 400));
        SeedPosts::make(30);
        SeedLayouts::make();
    }
}
