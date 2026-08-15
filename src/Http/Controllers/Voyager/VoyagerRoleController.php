<?php

namespace Classiebit\Eventmie\Http\Controllers\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerRoleController as BaseVoyagerRoleController;

class VoyagerRoleController extends BaseVoyagerRoleController
{
    public function callAction($method, $parameters)
    {
        if (!config('voyager.pkg_dev_mode')) {
            abort(403, 'Only available in developer mode');
        }

        return parent::callAction($method, $parameters);
    }
}
