<?php

namespace App\Http\Actions\Api\Tests;

use Illuminate\Http\Request;
use App\Models\Test;

use App\Http\Actions\Controller;

class PatchShareTest extends Controller
{
    public function __invoke(Request $request, Test $test)
    {
        $test->share += 1;
        $test->saveOrFail();

        return response([], 204);
    }
}
