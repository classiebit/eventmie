<?php

namespace Classiebit\Eventmie\Http\Controllers;

use Classiebit\Eventmie\Models\Page;
use Facades\Classiebit\Eventmie\Eventmie;
use Illuminate\Routing\Controller;

class PagesController extends Controller
{
    public function __construct()
    {
        // language change
        $this->middleware('common');
    }

    // get featured events
    public function view($page = null, $view = 'eventmie::pages', $extra = [])
    {
        $page = Page::where([
            'slug' => $page,
            'status' => Page::STATUS_ACTIVE,
        ])->firstOrFail();

        return Eventmie::view($view, compact('page', 'extra'));
    }
}
