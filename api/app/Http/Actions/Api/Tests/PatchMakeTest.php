<?php

namespace App\Http\Actions\Api\Tests;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Token;

use App\Http\Actions\Controller;

class PatchMakeTest extends Controller
{
    public function __invoke(Request $request, Test $test)
    {
        $lang = $request->lang;

        $validated = $request->validate([
          "token" => 'required',
        ]);

        $token = Token::where('token', $validated['token'])
        ->firstOrCreate(['token' => $validated['token']]);

        $test->tested += 1;
        $test->saveOrFail();

        return response([], 204);
    }
}
