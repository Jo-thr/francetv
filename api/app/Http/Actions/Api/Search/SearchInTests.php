<?php

namespace App\Http\Actions\Api\Search;

use Illuminate\Http\Request;
use App\Http\Actions\Controller;
use App\Models\Test;
use App\Http\Resources\TestResource;

class SearchInTests extends Controller
{
    public function __invoke(Request $request)
    {
        $query = str_replace(' ', ' & ', $request->q);

        $q = Test::search($query.':A*')
        ->orderBy('start_at', 'DESC')
        ->usingTsQuery()
        ->paginate(15);

        return TestResource::collection($q);
    }
}
