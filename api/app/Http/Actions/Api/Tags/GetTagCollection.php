<?php

namespace App\Http\Actions\Api\Tags;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

use App\Http\Actions\Controller;
use App\Http\Resources\TagResource;

use App\Models\Tag;


class GetTagCollection extends Controller
{
    public function __invoke(Request $request)
    {
        $q = QueryBuilder::for(Tag::class)
        ->allowedSorts(['name'])
        ->paginate(15);

        return TagResource::collection($q);
    }
}
