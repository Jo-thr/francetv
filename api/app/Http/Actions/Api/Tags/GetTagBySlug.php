<?php

namespace App\Http\Actions\Api\Tags;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

use App\Http\Actions\Controller;
use App\Http\Resources\TagResource;

use App\Models\Tag;

class GetTagBySlug extends Controller
{
    public function __invoke(Request $request, string $slug)
    {
        $lang = $request->lang;
        $q = Tag::where('slug->'.$lang, $slug)
        ->firstOrFail();

        return new TagResource($q);
    }
}
