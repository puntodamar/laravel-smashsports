<?php

namespace Modules\Schedule\App\Http\Middleware;

use Closure;
use Inertia\Inertia;

class UseScheduleInertiaRoot
{
    public function handle($request, Closure $next)
    {
        Inertia::setRootView('schedule::index'); // use module root view
        return $next($request);
    }
}
