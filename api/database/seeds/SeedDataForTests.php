<?php

use Illuminate\Database\Seeder;

class SeedDataForTests extends Seeder
{
    public function run()
    {
        SeedDepartements::make();
        SeedPictogramsAndSponsors::make();
        SeedUsers::make(1, rand(2, 5));
        SeedMetaMedia::make(5);
        SeedPosts::make(1);
        SeedTests::make(2, rand(10, 23));
        SeedLayouts::make();
    }
}
