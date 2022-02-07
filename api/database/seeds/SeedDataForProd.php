<?php

use Illuminate\Database\Seeder;

class SeedDataForProd extends Seeder
{
    public function run()
    {
        SeedLayoutsForProd::make();
    }
}
