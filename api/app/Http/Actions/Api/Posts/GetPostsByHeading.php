<?php

namespace App\Http\Actions\Api\Posts;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

use App\Http\Actions\Controller;
use App\Http\Resources\PostResource;

use App\Models\Heading;
use App\Models\Post;
use App\Models\Layout;

class GetPostsByHeading extends Controller
{

    public function __invoke(Request $request, string $slug)
    {
        $lang = $request->lang;

        $heading = Heading::bySlug($slug, $lang);

        if(!$heading) abort(404);

        $postToExclude = Layout::where('name', $heading->slug('en'))
        ->firstOrFail()
        ->postsToExclude();

        if (!$heading) {
            return abort(404);
        }

        $q = QueryBuilder::for(Post::class)
            ->whereNotIn('id', $postToExclude)
            ->where('heading', $heading::$key)
            ->where('published', true)
            ->where('published_at', '<=', now())
            ->ordered()
            ->paginate(15);

        return PostResource::collection($q);
    }
}
