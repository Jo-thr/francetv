<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;

class Token extends Model
{
    use Uuids;

    protected $fillable = [
      'token'
    ];

    public function token()
    {
        return $this->belongsTo('\App\Models\Token');
    }

    public function test()
    {
        return $this->belongsTo('\App\Models\Test');
    }
}
