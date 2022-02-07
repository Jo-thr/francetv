<?php

namespace App\Http\Actions\Api\Headings;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

use App\Http\Actions\Controller;
use App\Http\Resources\HeadingResource;

use App\Models\Heading;

class GetHeadingBySlug extends Controller
{
    public function __invoke(Request $request, string $slug)
    {
        $heading = Heading::bySlug($slug, $request->lang);
        if($heading) {
          return new HeadingResource($heading);
        }
        abort(404);
    }
}
