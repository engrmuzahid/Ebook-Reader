<?php

namespace App\Http\Middleware;

use Closure;
use App\Updater;

class RunUpdater
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (file_exists(storage_path('app/update'))) {
            Updater::run();
        }

        return $next($request);
    }
}
