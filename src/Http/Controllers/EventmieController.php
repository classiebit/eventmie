<?php

namespace Classiebit\Eventmie\Http\Controllers;

use App\Http\Controllers\Controller; 
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

    public function logout()
    {
        Auth::logout();
        
        $redirect = !empty(config('eventmie.route.prefix')) ? config('eventmie.route.prefix') : '/';
        return redirect($redirect);
    }

    public function assets(Request $request)
    {
        if(class_exists('\Str'))
            $path = \Str::start(str_replace(['../', './'], '', urldecode($request->path)), DIRECTORY_SEPARATOR);
        else
            $path = str_start(str_replace(['../', './'], '', urldecode($request->path)), DIRECTORY_SEPARATOR);
        
        // detect package development mode
        // if in package development mode then base will be package else vendor
        $base = 'vendor'.DIRECTORY_SEPARATOR.'classiebit'.DIRECTORY_SEPARATOR;
        if(config('voyager.pkg_dev_mode') || config('voyager.demo_mode'))
            $base = '..'.DIRECTORY_SEPARATOR;
        
        $path = base_path($base.'eventmie'.DIRECTORY_SEPARATOR.'publishable'.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.$path);

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
        \Session::put('my_lang', $lang);

        return redirect($_SERVER['HTTP_REFERER']);
    }        
    
     
}
