<?php 

namespace Classiebit\Eventmie\Middleware;
use Closure;
use Carbon\Carbon;

class CommonMiddleware {

    public function handle($request, Closure $next)
    {
        // if user lang
        $lang = session('my_lang');
        if ($lang && is_string($lang) && preg_match('/^[a-zA-Z]{2}(_[a-zA-Z]{2})?$/', $lang))
        {
            \App::setLocale($lang);
            
            Carbon::setLocale($lang);
        }    

        return $next($request);
    }
}