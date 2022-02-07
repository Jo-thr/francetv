<?php

namespace App\Http\Actions\Api\MetaMedia;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

use App\Http\Actions\Controller;
use App\Http\Resources\MetaMediaResource;

use App\Models\MetaMedia;
use App\Models\Layout;
use App\Models\States\LayoutType\MetaMedia as MetaMediaState;


class GetMetaMediaCollection extends Controller
{
    public function __invoke(Request $request)
    {

        $q = QueryBuilder::for(MetaMedia::class)
        ->orderByDesc('published_at')
        ->ordered()
        ->paginate(15);

        return MetaMediaResource::collection($q);
    }
}
