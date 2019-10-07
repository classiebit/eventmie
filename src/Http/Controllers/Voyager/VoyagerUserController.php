<?php

namespace Classiebit\Eventmie\Http\Controllers\Voyager;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerUserController as BaseVoyagerUserController;

class VoyagerUserController extends BaseVoyagerUserController
{
    // POST BR(E)AD
    public function update(Request $request, $id)
    {
        // demo mode restrictions
        if(config('voyager.demo_mode'))
        {
            return redirect()
                    ->route("voyager.users.index")
                    ->with([
                        'message'    => 'Demo mode',
                        'alert-type' => 'info',
                    ])
                    ->send();
        }

        if (app('VoyagerAuth')->user()->getKey() == $id) {
            $request->merge([
                'role_id'                              => app('VoyagerAuth')->user()->role_id,
                'user_belongsto_role_relationship'     => app('VoyagerAuth')->user()->role_id,
                'user_belongstomany_role_relationship' => app('VoyagerAuth')->user()->roles->pluck('id')->toArray(),
            ]);
        }

        return parent::update($request, $id);
    }
}
