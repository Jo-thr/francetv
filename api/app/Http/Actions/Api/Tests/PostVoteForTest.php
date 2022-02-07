<?php

namespace App\Http\Actions\Api\Tests;

use Illuminate\Http\Request;

use App\Http\Actions\Controller;
use App\Http\Resources\TestResource;

use App\Models\Test;
use App\Models\Vote;
use App\Models\Token;

class PostVoteForTest
{
    public function __invoke(Request $request, Test $test)
    {
        $lang = $request->lang;

        $validated = $request->validate([
          "token" => 'required',
        ]);

        $token = Token::where('token', $validated['token'])
        ->firstOrCreate(['token' => $validated['token']]);

        if (Vote::where('token_id', $token->id)->where('test_id', $test->id)->first()) {
            return response(['message' => 'User already voted'], 403);
        }

        $vote = new Vote;
        $vote->note = 1;
        $vote->token_id = $token->id;
        $vote->test_id = $test->id;
        $vote->save();

        return response([], 204);
    }
}
