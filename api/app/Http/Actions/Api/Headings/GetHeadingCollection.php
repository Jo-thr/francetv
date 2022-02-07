<?php

namespace App\Http\Actions\Api\Headings;

use Illuminate\Http\Request;

use App\Http\Actions\Controller;
use App\Http\Resources\HeadingResource;

use App\Models\Heading;

class GetHeadingCollection extends Controller
{
    public function __invoke()
    {
        return HeadingResource::collection(Heading::all());
    }
}
