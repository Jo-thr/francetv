<?php

namespace App\Http\Middleware;

use Closure;

class ApiLang
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
        if (is_null($request->lang)) {
            $request->lang = 'fr';
        }

        app()->setLocale($request->lang);

        return $next($request);
    }
}
