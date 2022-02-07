<?php

namespace App\Http\Actions\Api;

use Illuminate\Http\Request;

use App\Http\Actions\Controller;

class GetFallbackAction extends Controller
{
    public function __invoke(Request $request)
    {
        return response()->json([
          'url' => $request->url(),
          'method' => $request->method(),
          'message'=>'Not Found',
          'code' => 404,
        ], 404);
    }
}
