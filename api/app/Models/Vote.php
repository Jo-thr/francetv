<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;

class Vote extends Model
{
    use Uuids;

    public function test()
    {
        return $this->belongsTo(\App\Models\Test::class, 'test_id');
    }
}
