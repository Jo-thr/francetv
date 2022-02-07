<?php

namespace App\Http\Actions\Api\Tests;

use App\Http\Actions\Controller;
use App\Http\Resources\TestResource;
use App\Models\Test;
use Illuminate\Http\Request;

class GetTest extends Controller
{
    public function __invoke(Request $request, Test $test)
    {
        return new TestResource($test);
    }
}
