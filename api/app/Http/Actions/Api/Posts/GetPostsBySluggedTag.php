<?php

namespace App\Http\Actions\Api\Posts;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

use App\Http\Actions\Controller;
use App\Http\Resources\PostResource;

use App\Models\Tag;

class GetPostsBySluggedTag extends Controller
{
    public function __invoke(Request $request, string $slug)
    {
        $lang = $request->lang;
        $tag = Tag::where('slug->'.$lang, $slug)
                  ->firstOrFail();

        $q = $tag->posts()
            ->where('published', true)
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'DESC')
            ->paginate(15);

        return PostResource::collection($q);
    }
}
