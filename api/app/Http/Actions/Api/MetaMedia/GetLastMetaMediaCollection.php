<?php

namespace App\Http\Actions\Api\MetaMedia;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

use App\Http\Actions\Controller;
use App\Http\Resources\MetaMediaResource;

use App\Models\MetaMedia;
use App\Models\Layout;
use App\Models\States\LayoutType\MetaMedia as MetaMediaState;


class GetLastMetaMediaCollection extends Controller
{
    public function __invoke(Request $request)
    {

        $q = QueryBuilder::for(MetaMedia::class);
        return MetaMediaResource::collection(
            $q->orderByDesc('published_at')
            ->limit(4)
            ->get()
        );
    }
}
