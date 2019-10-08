<?php

namespace Classiebit\Eventmie\Http\Controllers;
use App\Http\Controllers\Controller; 
use Facades\Classiebit\Eventmie\Eventmie;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use DB;


class PagesController extends Controller
{

    public function __construct()
    {
        // language change
        $this->middleware('common');
    }
    
    public function view($page = null)
    {
        $page   = DB::table('pages')->where(['slug' => $page])->first();
        
        return Eventmie::view('eventmie::pages', compact('page'));
   }
}    