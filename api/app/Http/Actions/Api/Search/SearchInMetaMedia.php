<?php

namespace App\Http\Actions\Api\Search;

use Illuminate\Http\Request;
use App\Http\Actions\Controller;
use App\Models\MetaMedia;
use App\Http\Resources\MetaMediaResource;

class SearchInMetaMedia extends Controller
{
    public function __invoke(Request $request)
    {
        $query = str_replace(' ', ' & ', $request->q);

        $q = MetaMedia::search($query.':A*')
        ->orderBy('published_at', 'DESC')
        ->usingTsQuery()
        ->paginate(15);

        return MetaMediaResource::collection($q);
    }
}
