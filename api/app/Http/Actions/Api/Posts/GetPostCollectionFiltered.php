<?php

namespace App\Http\Actions\Api\Posts;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

use App\Http\Actions\Controller;
use App\Http\Resources\PostAbstractResource;

use App\Models\Post;
use App\Models\Test as TestModel;
use App\Models\Layout;

use App\Models\States\Category\Article;
use App\Models\States\Category\External;
use App\Models\States\Category\Contribution;

use App\Models\States\Type\Read;
use App\Models\States\Type\See;
use App\Models\States\Type\Listen;
use App\Models\States\Type\Test;

class GetPostCollectionFiltered extends Controller
{

    public function __invoke(Request $request)
    {
        $q = Layout::where('name', 'home')
        ->firstOrFail();

        $listen = Post::select('id')
        ->whereNotIn('id', $q->postsToExclude())
        ->where('type', Listen::$key)
        ->where('category', '!=', Contribution::$key)
        ->where('published_at', '<=', now())
        ->where('published', true)
        ->orderBy('published_at', 'DESC')
        ->limit(5)
        ->get();

        $read = Post::select('id')
        ->whereNotIn('id', $q->postsToExclude())
        ->where('type', Read::$key)
        ->where('category', '!=', Contribution::$key)
        ->where('published_at', '<=', now())
        ->where('published', true)
        ->orderBy('published_at', 'DESC')
        ->limit(5)
        ->get();

        $test = Post::select('id')
        ->whereNotIn('id', $q->postsToExclude())
        ->where('type', Test::$key)
        ->where('category', '!=', Contribution::$key)
        ->where('published_at', '<=', now())
        ->where('published', true)
        ->orderBy('published_at', 'DESC')
        ->limit(5)
        ->get();

        $test2 = TestModel::select('id')
        ->whereNotIn('id', $q->postsToExclude())
        ->where('end_at', '>', now())
        ->where('start_at', '<=', now())
        ->where('paused', false)
        ->limit(5)
        ->get();

        $toTest = $test
        ->merge($test2)
        ->sortByDesc('published_at')
        ->slice(0, 5);

        $see = Post::select('id')
        ->whereNotIn('id', $q->postsToExclude())
        ->where('type', See::$key)
        ->where('category', '!=', Contribution::$key)
        ->where('published_at', '<=', now())
        ->where('published', true)
        ->orderBy('published_at', 'DESC')
        ->limit(5)
        ->get();

        $postToExclude = collect(array_merge(
            $see->toArray(),
            $read->toArray(),
            $test->toArray(),
            $listen->toArray(),
        ))->pluck('id');

        $allExclusions = array_merge($q->postsToExclude(), $postToExclude->toArray());

        $allPosts = Post::select(Post::$columns)
        ->whereNotIn('id', $allExclusions)
        ->where('category', '!=', Contribution::$key)
        ->where('published_at', '<=', now())
        ->where('published', true)
        ->orderBy('published_at', 'DESC')
        ->paginate(15);

        return PostAbstractResource::collection($allPosts);
    }
}
