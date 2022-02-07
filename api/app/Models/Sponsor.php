<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;

class Sponsor extends Model
{
    use Uuids;

    protected $fillable = [
      'name', 'logo'
    ];
}
