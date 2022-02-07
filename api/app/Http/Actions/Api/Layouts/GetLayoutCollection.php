<?php

namespace App\Http\Actions\Api\Layouts;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

use App\Http\Actions\Controller;
use App\Http\Resources\LayoutResource;

use App\Models\Layout;

class GetLayoutCollection extends Controller
{
    public function __invoke()
    {
        $q = QueryBuilder::for(Layout::class)->get();

        return LayoutResource::collection($q);
    }
}
