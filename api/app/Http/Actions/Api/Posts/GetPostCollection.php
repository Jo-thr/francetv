<?php

namespace App\Http\Actions\Api\Posts;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

use App\Http\Actions\Controller;
use App\Http\Resources\PostAbstractResource;
use App\Http\Resources\ToTestAbstractResource;

use App\Models\Post;
use App\Models\States\Type\Test as TestType;
use App\Models\Test as TestModel;
use App\Models\Layout;

class GetPostCollection extends Controller
{

    public function __invoke(Request $request)
    {

        $q = QueryBuilder::for(Post::class)
            ->allowedFilters(['type','category','heading'])
            ->allowedSorts(['published_at']);

        if(isset($request->filter) && $request->filter['type'] === "test" && $request->home)
        {
            $layout = Layout::where('name', 'home')
                ->firstOrFail();

            $test = Post::select(...Post::$columns)
            ->whereNotIn('id', $layout->postsToExclude())
            ->where('type', TestType::$key)
            ->where('published_at', '<=', now())
            ->where('published', true)
            ->orderBy('published_at', 'DESC')
            ->limit(5)
            ->get();

            $test2 = TestModel::whereNotIn('id', $layout->postsToExclude())
            ->where('end_at', '>', now())
            ->where('start_at', '<=', now())
            ->where('paused', false)
            ->orderBy('start_at', 'DESC')
            ->limit(5)
            ->get();

            $toTest = $test
            ->merge($test2)
            ->sortByDesc('published_at')
            ->slice(0, 5);

            return ToTestAbstractResource::collection($toTest);
        }


        if($request->home){
            $layout = Layout::where('name', 'home')
            ->firstOrFail();

            $q = $q
            ->whereNotIn('id', $layout->postsToExclude())
            ->orderBy('published_at', 'DESC');

        } else {
            $q = $q->ordered();
        }

        $q = $q->where('published', true)
        ->where('published_at', '<=', now());

        if($request->query('section')) {
            return PostAbstractResource::collection(
                $q->where('flag', '=', $request->query('section'))
                    ->reorder('published_at', 'DESC')
                    ->paginate(18)
            );
        }

        if ($request->limit) {
            return PostAbstractResource::collection(
                $q->limit($request->limit)->get()
            );
        }

        return PostAbstractResource::collection($q->paginate(15));
    }
}
