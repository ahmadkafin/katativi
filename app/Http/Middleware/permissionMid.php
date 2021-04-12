<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class permissionMid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ((auth()->check()) && (auth()->user()->permission == 1)) {
            return $next($request);
        }
        abort(403);
    }
}
