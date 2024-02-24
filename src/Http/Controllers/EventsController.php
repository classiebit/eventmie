<?php

namespace Classiebit\Eventmie\Http\Controllers;
use App\Http\Controllers\Controller; 
use Facades\Classiebit\Eventmie\Eventmie;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Classiebit\Eventmie\Models\Event;
use Classiebit\Eventmie\Models\Category;
use Classiebit\Eventmie\Models\Country;
use Classiebit\Eventmie\Models\Booking;


class EventsController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // language change
        $this->middleware('common');
    
        $this->event    = new Event;
        $this->category = new Category;
        $this->country  = new Country;
        $this->booking      = new Booking;
    }

    /* ==================  EVENT LISTING ===================== */

    /**
     * Show all events
     *
     * @return array
     */
    public function index($view = 'eventmie::events.index', $extra = [])
    {
        // get prifex from eventmie config
        $path = false;
        if(!empty(config('eventmie.route.prefix')))
            $path = config('eventmie.route.prefix');

        return Eventmie::view($view, compact('path', 'extra'));
    }


    // filters for get_events function
    protected function event_filters(Request $request)
    {
        $request->validate([
            'category'          => 'max:256|String|nullable',
            'search'            => 'max:256|String|nullable',
            'start_date'        => 'date_format:Y-m-d|nullable',
            'end_date'          => 'date_format:Y-m-d|nullable',
            'city'              => 'max:256|String|nullable',
            'state'             => 'max:256|String|nullable',
            'country'           => 'max:256|String|nullable',    
            
        ]);
        
        $category_id            = null;
        $category               = urldecode($request->category); 
        $search                 = $request->search;
        $city                   = $request->city == 'All' ? '' : $request->city;
        $state                  = $request->state == 'All' ? '' : $request->state;
        $country_id             = null;
        $country                = urldecode($request->country); 
        
        // search category id
        if(!empty($category))
        {
            $categories  = $this->category->get_categories();

            foreach($categories as $key=> $value)
            {
                if($value['name'] == $category)
                    $category_id = $value['id'];
            }
        }

        // search country id
        if(!empty($country))
        {
            $countries = $this->country->get_countries();

            foreach($countries as $key=> $value)
            {
                if($value['country_name'] == $country)
                    $country_id = $value['id'];
            }
        }

        $filters                    = [];
        $filters['category_id']     = $category_id;
        $filters['search']          = $search;
        $filters['start_date']      = $request->start_date;
        $filters['end_date']        = $request->end_date;
        $filters['city']            = $city;
        $filters['state']           = $state;
        $filters['country_id']      = $country_id;
        
        // in case of today and tomorrow and weekand
        if($request->start_date == $request->end_date)
            $filters['end_date']     = null;

        return $filters;    
    }

    // EVENT LISTING APIs
    // get all events
    public function events(Request $request)
    {
        $filters         = [];
        // call event fillter function
        $filters         = $this->event_filters($request);

        $events          = $this->event->events($filters);
        
        $event_ids       = [];

        foreach($events as $key => $value)
            $event_ids[] = $value->id;

        $events_data             = [];
        foreach($events as $key => $value)
        {
            $events_data[$key]             = $value;
        }
        
        // set pagination values
        $event_pagination = $events->jsonSerialize();

        // get all countries
        $data = $this->country->get_countries_having_events($filters['country_id']);
        
        $countries = $data['countries'];
        $states    = $data['states'];
        $cities    = $data['cities'];
        
        return response([
            'events'=> [
                'data' => $events_data,
                'total' => $event_pagination['total'],
                'per_page' => $event_pagination['per_page'],
                'current_page' => $event_pagination['current_page'],
                'last_page' => $event_pagination['last_page'],
                'from' => $event_pagination['from'],
                'to' => $event_pagination['to'],
                'countries' => $countries,
                'cities'    => $cities,
                'states'    => $states
            ],
        ], Response::HTTP_OK);
    }

    /**
     * Show single event
     *
     * @return array
     */
    public function show(Event $event, $view = 'eventmie::events.show', $extra = [])
    {
        // it is calling from model because used subquery
        $event = $this->event->get_event($event->slug);

        if(!$event->status || !$event->publish)
            abort('404');
        
        // check if category is disabled
        $category            = $this->category->get_event_category($event['category_id']);
        
        if(empty($category))
            abort('404');

        $max_ticket_qty      = (int) setting('booking.max_ticket_qty'); 

        // event country
        $country            = $this->country->get_event_country($event['country_id']);

        // check event and or not 
        $ended  = false;

        // check event is ended or not
        if(\Carbon\Carbon::now()->format('Y/m/d') > \Carbon\Carbon::createFromFormat('Y-m-d', $event['start_date'])->format('Y/m/d'))
            $ended = true;    
        
        return Eventmie::view($view, compact(
            'event', 'ended', 'category', 'country', 'max_ticket_qty', 'extra'));
    }


     // get all categories
    public function categories()
    {
        $categories  = $this->category->get_categories();

        if(empty($categories))
        {
            return response()->json(['status' => false]);    
        }
        return response()->json(['status' => true, 'categories' => $categories ]);
    }   

    // get all City
    public function cities()
    {

        $data = $this->country->get_countries_having_events();
        $cities    = $data['cities'];

        if(empty($cities))
        {
            return response()->json(['status' => false]);    
        }
        return response()->json(['status' => true, 'cities' => $cities ]);
    }   

}
