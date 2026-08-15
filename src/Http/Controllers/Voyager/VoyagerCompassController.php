<?php

namespace Classiebit\Eventmie\Http\Controllers\Voyager;

use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerCompassController as BaseVoyagerCompassController;

class VoyagerCompassController extends BaseVoyagerCompassController
{
    /**
     * Compass can run artisan commands (CVE-2025-32931), delete arbitrary
     * files (CVE-2024-55415), and reflect unsanitized names into JS
     * (CVE-2024-55416). Keep it off unless package development mode is on,
     * never execute artisan from the web, and only allow laravel*.log names.
     */
    public function callAction($method, $parameters)
    {
        if (!config('voyager.pkg_dev_mode')) {
            abort(403, 'Only available in developer mode');
        }

        return parent::callAction($method, $parameters);
    }

    public function index(Request $request)
    {
        if ($request->isMethod('post') && $request->filled('command')) {
            abort(403, 'Artisan commands cannot be run from the web');
        }

        foreach (['log', 'download', 'del'] as $field) {
            if ($request->has($field)) {
                $decoded = base64_decode((string) $request->input($field), true);
                $file = $decoded === false ? '' : basename($decoded);

                if (!preg_match('/^laravel(-[\d-]+)?\.log$/', $file)) {
                    abort(403);
                }

                $request->merge([$field => base64_encode($file)]);
            }
        }

        return parent::index($request);
    }
}
