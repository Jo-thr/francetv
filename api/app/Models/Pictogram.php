<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;

class Pictogram extends Model
{
    use Uuids;

    protected $fillable = [
      'title', 'image'
    ];
}
