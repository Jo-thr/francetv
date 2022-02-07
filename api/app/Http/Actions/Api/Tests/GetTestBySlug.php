<?php

namespace App\Http\Actions\Api\Tests;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

use App\Http\Actions\Controller;
use App\Http\Resources\TestResource;

use App\Models\Test;

class GetTestBySlug extends Controller
{
    public function __invoke(Request $request, string $slug)
    {
        $lang = $request->lang;

        $q = QueryBuilder::for(Test::class)
        ->where('slug->'.$lang, $slug)
        ->firstOrFail();

        return new TestResource($q);
    }
}
