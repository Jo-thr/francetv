<?php

namespace App\Http\Actions\Api\Tags;

use App\Http\Actions\Controller;
use App\Http\Resources\SearchResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class GetContentByTag extends Controller
{
    public function __invoke(Request $request, Tag $tag)
    {
        $lang = $request->lang;

        $posts = $tag->posts()
                ->where('published', true)
                ->where('published_at', '<=', now())
                ->get();

        $tests = $tag->tests()
                ->where('start_at', '<=', now())
                ->where('end_at', '>=', now())
                ->get();

        $collection = $tests
        ->merge($posts)
        ->sortByDesc('published_at')
        ->paginate(15);

        return SearchResource::collection($collection);
    }
}
