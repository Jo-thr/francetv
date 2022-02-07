<?php

namespace App\Http\Actions\Api\Tests;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

use App\Http\Actions\Controller;
use App\Http\Resources\TestResource;

use App\Models\Test;
use App\Models\Layout;

class GetTestCollection extends Controller
{
    public function __invoke(Request $request)
    {

        $postToExclude = Layout::where('name', 'tests')
        ->firstOrFail()
        ->postsToExclude();

        $q = QueryBuilder::for(Test::class)
        ->whereNotIn('id', $postToExclude)
        ->orderBy('start_at', 'DESC');

        if ($request->type === "finished") {
            $q = $q->where('end_at', '<=', now());
        }

        if ($request->type === "open") {
            $q = $q->where('end_at', '>', now())
            ->where('start_at', '<=', now())
            ->where('paused', false);
        }

        if ($request->type === "onpause") {
            $q = $q->where('end_at', '>', now())
            ->where('paused', true);
        }

        if ($request->type === "soon") {
            $q = $q->where('start_at', '>', now())
            ->where('paused', false);
        }

        return TestResource::collection($q->paginate(15));
    }
}
