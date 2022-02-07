<?php

namespace App\Http\Actions\Api\Search;

use Illuminate\Http\Request;
use App\Http\Actions\Controller;
use App\Models\Post;
use App\Models\MetaMedia;
use App\Models\Test;

use App\Http\Resources\SearchResource;

class SearchInContent extends Controller
{
    public function __invoke(Request $request)
    {
        $query = str_replace(' ', ' & ', $request->q);

        $posts = Post::search($query.':*')
        ->where('published', true)
        ->orderBy('published_at', 'DESC')
        ->usingTsQuery()
        ->get();

        $metamedia = MetaMedia::search($query.':*')
        ->orderBy('published_at', 'DESC')
        ->usingTsQuery()
        ->get();

        $tests = Test::search($query.':*')
        ->orderBy('start_at', 'DESC')
        ->usingTsQuery()
        ->get();

        $collection = $posts->merge($metamedia);

        $collection = $collection->merge($tests)
        ->sortByDesc('published_at')
        ->paginate(15);

        return SearchResource::collection($collection);
    }
}
