<?php

namespace Classiebit\Eventmie\Http\Controllers;

use Illuminate\Routing\Controller; 
use Facades\Classiebit\Eventmie\Eventmie;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use Auth;

class EventmieController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // language change
        $this->middleware('common');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        $redirect = !empty(config('eventmie.route.prefix')) ? config('eventmie.route.prefix') : '/';
        return redirect($redirect);
    }

    public function assets(Request $request)
    {
        $raw = urldecode((string) $request->path);
        $raw = str_replace(['../', '..\\', './', '.\\'], '', $raw);
        $raw = ltrim($raw, '/\\');

        if ($raw === '' || strpos($raw, "\0") !== false) {
            return response('', 404);
        }

        if (!preg_match('/\.(css|js|map|woff2?|ttf|eot|png|jpe?g|gif|svg|ico|webp)$/i', $raw)) {
            return response('', 404);
        }
        
        // detect package development mode
        // if in package development mode then base will be package else vendor
        $base = 'vendor'.DIRECTORY_SEPARATOR.'classiebit'.DIRECTORY_SEPARATOR;
        if(config('voyager.pkg_dev_mode') || config('voyager.demo_mode'))
            $base = '..'.DIRECTORY_SEPARATOR;
        
        $assetsRoot = realpath(base_path($base.'eventmie'.DIRECTORY_SEPARATOR.'publishable'.DIRECTORY_SEPARATOR.'assets'));
        if ($assetsRoot === false) {
            return response('', 404);
        }

        $path = realpath($assetsRoot.DIRECTORY_SEPARATOR.str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $raw));
        $root = rtrim($assetsRoot, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;

        if ($path === false || (strpos($path, $root) !== 0 && $path !== $assetsRoot) || !is_file($path)) {
            return response('', 404);
        }

        if (File::exists($path)) {
            $mime = '';

            if(class_exists('\Str'))
            {
                if (\Str::endsWith($path, '.js')) {
                    $mime = 'text/javascript';
                } elseif (\Str::endsWith($path, '.css')) {
                    $mime = 'text/css';
                } else {
                    $mime = File::mimeType($path);
                }
            }
            else
            {
                if (ends_with($path, '.js')) {
                    $mime = 'text/javascript';
                } elseif (ends_with($path, '.css')) {
                    $mime = 'text/css';
                } else {
                    $mime = File::mimeType($path);
                }
            }
            
            $response = response(File::get($path), 200, ['Content-Type' => $mime]);
            $response->setSharedMaxAge(31536000);
            $response->setMaxAge(31536000);
            $response->setExpires(new \DateTime('+1 year'));

            return $response;
        }

        return response('', 404);
    }


    public function change_lang($lang = null)
    {
        $allowed = lang_selector();
        if (!in_array($lang, $allowed, true)) {
            $lang = config('eventmie.default_lang', config('app.locale'));
        }

        \Session::put('my_lang', $lang);

        $referer = request()->headers->get('referer');
        if ($referer) {
            $refererHost = parse_url($referer, PHP_URL_HOST);
            if ($refererHost && $refererHost === request()->getHost()) {
                return redirect($referer);
            }
        }

        return redirect()->route('eventmie.welcome');
    }        
    
     
}
