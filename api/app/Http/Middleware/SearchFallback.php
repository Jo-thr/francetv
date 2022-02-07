<?php

namespace App\Http\Middleware;

use Closure;

class SearchFallback
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->get('q')) {
            return response()->json([
            'url' => $request->url(),
            'method' => $request->method(),
            'message'=>'Bad Request',
            'code' => 400,
          ], 400);
        }

        return $next($request);
    }
}
