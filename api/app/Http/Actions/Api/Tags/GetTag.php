<?php

namespace App\Http\Actions\Api\Tags;

use App\Http\Actions\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class GetTag extends Controller
{
    public function __invoke(Request $request, Tag $tag)
    {
        return new TagResource($tag);
    }
}
