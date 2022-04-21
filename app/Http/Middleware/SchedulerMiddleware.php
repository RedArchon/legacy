<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SchedulerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return int
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->header('X-SCHEDULER-HEADER') === 'secret!'){
            return $next($request);
        }

        return response()->status(403);
    }
}
