<?php

namespace App\Http\Actions\Api\Posts;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

use App\Http\Actions\Controller;
use App\Http\Resources\PostResource;

use App\Models\Post;

class GetPost extends Controller
{
    public function __invoke(Request $request, Post $post)
    {
        if ($post->published_at >= now() || $post->published === false) {
            abort(404);
        }
        return new PostResource($post);
    }
}
