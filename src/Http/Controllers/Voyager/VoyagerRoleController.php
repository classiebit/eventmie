<?php

namespace Classiebit\Eventmie\Http\Controllers\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerRoleController as BaseVoyagerRoleController;

class VoyagerRoleController extends BaseVoyagerRoleController
{
    public function __construct()
    {
        // disable modification when not in package development mode
        if (!config('voyager.pkg_dev_mode')) 
        {
            return redirect()
            ->route("voyager.events.index")
            ->with([
                'message'    => 'Only available in developer mode',
                'alert-type' => 'info',
            ])
            ->send();
        }
        // ---------------------------------------------------------------------
    }
}
