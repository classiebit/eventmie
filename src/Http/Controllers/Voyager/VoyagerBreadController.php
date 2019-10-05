<?php

namespace Classiebit\Eventmie\Http\Controllers\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerBreadController as BaseVoyagerBreadController;

class VoyagerBreadController extends BaseVoyagerBreadController
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
