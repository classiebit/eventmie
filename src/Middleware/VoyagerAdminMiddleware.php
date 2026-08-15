<?php

namespace Classiebit\Eventmie\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VoyagerAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        auth()->setDefaultDriver(app('VoyagerGuard'));

        if (!Auth::guest()) {
            $user = Auth::user();
            
            $lang = session('my_lang');
            if ($lang && is_string($lang) && preg_match('/^[a-zA-Z]{2}(_[a-zA-Z]{2})?$/', $lang)) {
                \App::setLocale($lang);
            }

            if (!$user->hasPermission('browse_admin')) {
                return redirect('/');
            }

            return app(SanitizeVoyagerUploads::class)->handle($request, $next);
        }

        $urlLogin = route('voyager.login');

        return redirect()->guest($urlLogin);
    }
}
