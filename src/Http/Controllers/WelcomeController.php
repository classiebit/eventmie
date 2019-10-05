<?php

namespace Classiebit\Eventmie\Http\Controllers;
use App\Http\Controllers\Controller; 
use Facades\Classiebit\Eventmie\Eventmie;
use Classiebit\Eventmie\Notifications\MailNotification;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Classiebit\Eventmie\Models\Event;
use Classiebit\Eventmie\Models\User;
use Classiebit\Eventmie\Models\Banner;
use Classiebit\Eventmie\Models\Category;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    
    public function __construct()
    {
        // language change
        $this->middleware('common');
    
        $this->event            = new Event;
        $this->banner           = new Banner;
        $this->user             = new User;
        $this->category         = new Category;
    }


    public function index()
    {
        $top_selling_events  = $this->get_top_selling_events();
        $upcomming_events    = $this->get_upcomming_events();
        $banners             = $this->banner->get_banners();
        $categories          = $this->category->get_categories();
        
        return Eventmie::view('eventmie::welcome', compact('top_selling_events', 'upcomming_events', 'banners', 'categories'));
    }

    // get top selling events API
    private function get_top_selling_events()
    {
        $top_selling_events  = $this->event->get_top_selling_events();

        $events_data             = [];
        foreach($top_selling_events as $key => $value)
            if($value->total_booking)
                $events_data[$key]     = $value;

        return  $events_data;
        
    }

    // get upcomming events
    private function get_upcomming_events()
    {
        $upcomming_events  = $this->event->get_upcomming_events();

        $events_data             = [];
        foreach($upcomming_events as $key => $value)
            $events_data[$key]             = $value;
        
        return  $events_data;
    }
}
