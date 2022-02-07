<?php

namespace App\Http\Actions\Api;

use Illuminate\Http\Request;
use App\Models\Token;

use App\Http\Actions\Controller;

/**
 * @group Test
 *
 * Post a new token
 */
class PostToken extends Controller
{
    /**
     * Add a new external user token
     * @param  Request $request
     *
     * @bodyParam token string required the external id of the user
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
          "token" => 'required|unique:App\Models\Token,token',
        ]);

        $token = new Token;
        $token->token = $validated['token'];
        $token->saveOrFail();

        return response([], 204);
    }
}
