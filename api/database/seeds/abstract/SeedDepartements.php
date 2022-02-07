<?php

use App\Models\Departement;

class SeedDepartements
{
    public static function make()
    {
        foreach (self::getDepartements() as $data) {
            Departement::create($data);
        }
    }

    private static function getDepartements()
    {
        return [
      [ 'name' => 'Departement 1', ],
      [ 'name' => 'Departement 2', ],
      [ 'name' => 'Departement 3', ],
      [ 'name' => 'Departement 4', ],
      [ 'name' => 'Departement 5', ],
      [ 'name' => 'Departement 6', ],
    ];
    }
}
