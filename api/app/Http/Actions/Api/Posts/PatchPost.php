<?php

namespace App\Http\Actions\Api\Posts;

use Illuminate\Http\Request;
use App\Models\Post;

use App\Http\Actions\Controller;

class PatchPost extends Controller
{
    /**
     * Updte share column in test
     * @param  Request $request
     *
     */
    public function __invoke(Request $request, Post $post)
    {
        $post->claps += 1;
        $post->saveOrFail();

        return response([], 204);
    }
}
