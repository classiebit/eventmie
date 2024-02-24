<?php

namespace Classiebit\Eventmie\Http\Controllers;
use App\Http\Controllers\Controller; 
use Facades\Classiebit\Eventmie\Eventmie;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Classiebit\Eventmie\Models\Page;


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
        $page   = Page::where(['slug' => $page])->firstOrFail();
        return Eventmie::view($view, compact('page', 'extra'));
   }
}    