<?php

namespace Classiebit\Eventmie\Actions;

use TCG\Voyager\Actions\AbstractAction;

class MyActions extends AbstractAction
{
    public function getTitle()
    {
        return __('eventmie::em.actions');
    }

    public function getIcon()
    {
        return 'voyager-eye';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right',
        ];
    }

    public function getDefaultRoute()
    {
        return route('eventmie.events');
    }
}