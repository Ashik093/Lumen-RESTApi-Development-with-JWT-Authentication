<?php

namespace App\Http\Middleware;

use Closure;

class CheckHeader
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
        if($request->header('apiKey')!='123'){
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
