<?php

namespace App\Http\Actions\Api\Tags;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

use App\Http\Actions\Controller;
use App\Http\Resources\SearchResource;

use App\Models\Tag;

class GetContentBySluggedTag extends Controller
{
    public function __invoke(Request $request, string $slug)
    {
        $lang = $request->lang;

        $tag = Tag::where('slug->'.$lang, $slug)
                  ->firstOrFail();

        $posts = $tag->posts()
                ->where('published', true)
                ->where('published_at', '<=', now())
                ->get();

        $tests = $tag->tests()
                ->where('start_at', '<=', now())
                ->where('end_at', '>=', now())
                ->get();

        $collection = $tests->merge($posts)
        ->sortByDesc('published_at')
        ->paginate(15);

        return SearchResource::collection($collection);
    }
}
