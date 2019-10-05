<?php namespace Classiebit\Eventmie\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware {

    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->hasRole('admin') )
        {
            return $next($request);
        }

        return redirect()->route('eventmie.welcome');
    }
}