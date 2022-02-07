<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;

class Departement extends Model
{
    use Uuids;

    public function users()
    {
        return $this->hasMany(\App\Models\User::class);
    }
}
