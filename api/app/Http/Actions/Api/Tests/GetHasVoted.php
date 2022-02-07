<?php

namespace App\Http\Actions\Api\Tests;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

use App\Http\Actions\Controller;
use App\Http\Resources\TestResource;

use App\Models\Test;
use App\Models\Token;
use App\Models\Vote;

class GetHasVoted extends Controller
{
    public function __invoke(Request $request, Test $test, string $token)
    {
        $token = Token::where('token', $token)->firstOrFail();

        $vote = Vote::where('token_id', $token->id)
        ->where('test_id', $test->id)
        ->first();

        if (isset($vote)) {
            return response()->json(true);
        }

        return response()->json(false);
    }
}
