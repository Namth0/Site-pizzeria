<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class IsCook
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->isCook()) {
            return $next($request);
        } else {
             abort(403,'You are not cook');
        }
    }
}
