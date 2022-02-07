<?php

namespace App\Http\Actions\Api\Search;

use Illuminate\Http\Request;
use App\Http\Actions\Controller;
use App\Models\Post;
use App\Http\Resources\PostAbstractResource;

class SearchInPosts extends Controller
{
    public function __invoke(Request $request)
    {
        $query = str_replace(' ', ' & ', $request->q);

        $q = Post::search($query.':*')
        ->where('published', true)
        ->orderBy('published_at', 'DESC')
        ->usingTsQuery()
        ->paginate(15);

        return PostAbstractResource::collection($q);
    }
}
