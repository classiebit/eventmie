<?php

namespace Classiebit\Eventmie\Http\Controllers\Voyager;
use Facades\Classiebit\Eventmie\Eventmie;

use TCG\Voyager\Http\Controllers\VoyagerController as BaseVoyagerController;

class VoyagerController extends BaseVoyagerController
{
    public function index()
    {
        return Eventmie::view('eventmie::vendor.voyager.dashboard');
    }

    public function logout()
    {
        app('VoyagerAuth')->logout();

        return redirect(config('eventmie.route.prefix').'/'.config('eventmie.route.admin_prefix'));
    }
}
