<?php

namespace Modules\Base\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VisitorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            
            $route = app('inAdmin') ? 'admin.dashboard.index' : 'account.dashboard.index';

            return redirect()->route($route);
        }

        return $next($request);
    }
}
