<?php

namespace App\Http\Actions\Api\Posts;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

use App\Http\Actions\Controller;
use App\Http\Resources\PostResource;

use App\Models\Post;

class GetPostBySlug extends Controller
{
    public function __invoke(Request $request, string $slug)
    {
        $lang = $request->lang;

        $q = QueryBuilder::for(Post::class)
            ->where('slug->'.$lang, $slug)
            ->where('published', true)
            ->where('published_at', '<=', now())
            ->firstOrFail();

        return new PostResource($q);
    }
}
