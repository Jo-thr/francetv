<?php

namespace App\Http\Actions\Api\Layouts;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

use App\Http\Actions\Controller;
use App\Http\Resources\LayoutResource;
use App\Http\Resources\LayoutStoryLabResource;

use App\Models\Layout;

class GetLayout extends Controller
{
    public function __invoke(Request $request, string $name)
    {
        $q = QueryBuilder::for(Layout::class)
        ->where('name', $name)
        ->firstOrFail();

        if ($name === "narrative-research") {
            return (new LayoutStoryLabResource($q))->response();
        }
        return (new LayoutResource($q))->response();
    }
}
