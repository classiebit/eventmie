<?php

namespace Classiebit\Eventmie\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use Classiebit\Eventmie\Models\Booking;

class Event extends Model
{
    
    protected $guarded = [];
    protected $with    = ['bookings'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     *  total events
     */

    public function total_events()
    {
        return Event::where(['status' => 1])->count();
    }

    // get event
    public function get_event($slug = null, $event_id = null)
    {   
        return Event::select('events.*')->from('events')
            ->where(['slug' => $slug])
            ->orWhere(['id' => $event_id])    
            ->selectRaw("(SELECT CT.name FROM categories CT WHERE CT.id = events.category_id) category_name")
            ->first();
    }

    // check event id that event id have login user or not    
    public function get_user_event($event_id = null)
    {
        return Event::select('events.*')->from('events')
                    ->where(['id' => $event_id])
                    ->first();
    }

    // create user event
    public function save_event($params = [], $event_id = null)
    {
       // if have no event id then create new event
       return Event::updateOrCreate(
            ['id' => $event_id],
            $params
        );
    }

    
    /**
     * Get events with 
     * pagination and custom selection
     * 
     * @return string
     */
    public function events($params  = [])
    {   
        $query = Event::query(); 
        
        $query
        ->leftJoin("categories", "categories.id", '=', "events.category_id")
        ->select(["events.*", "categories.name as category_name"]);

        if(!empty($params['search']))    
        {
            $query
            ->whereRaw("( title LIKE '%".$params['search']."%' 
                OR venue LIKE '%".$params['search']."%' OR state LIKE '%".$params['search']."%' OR city LIKE '%".$params['search']."%')");
        }

        if(!empty($params['city']))
        {
            $query
            ->where('city','LIKE',"%{$params['city']}%");
        }

        if(!empty($params['state']))
        {
            $query
            ->where('state','LIKE',"%{$params['state']}%");
        }
            
        $query->selectRaw("(SELECT CN.country_name FROM countries CN WHERE CN.id = events.country_id) country_name");
        
        if(!empty($params['category_id']))
            $query->where('category_id',$params['category_id']);

        if(!empty($params['country_id']))
            $query->where('country_id',$params['country_id']);

 
        if(!empty($params['start_date']) && !empty($params['end_date']))
        {
            $query ->where('start_date', '>=' , $params['start_date']);
            $query ->where('start_date', '<=' , $params['end_date']);
        }
        

        $query
        ->where(["events.status" => 1, "events.publish" => 1, "categories.status" => 1]);
        
        // if hide expired events is on
        if(!empty(setting('booking.hide_expire_events')))
        {   
            $today  = \Carbon\carbon::now(setting('regional.timezone_default'))->format('Y-m-d');    
            $query->whereRaw('(IF(events.repetitive = 1, events.end_date >= "'.$today.'", events.start_date >= "'.$today.'"))');
        }

        return $query->orderBy('events.start_date', 'ASC')->paginate(9);
    }
    
    // get top selling event
    public function get_top_selling_events()
    {
        return Event::leftJoin("categories", "categories.id", '=', "events.category_id")
                ->select(["events.*", "categories.name as category_name"])
                ->selectRaw("(SELECT SUM(BK.quantity) FROM bookings BK WHERE BK.event_id = events.id) total_booking")
                ->selectRaw("(SELECT CN.country_name FROM countries CN WHERE CN.id = events.country_id) country_name")
                ->where(['events.publish' => 1, 'events.status' => 1, 'categories.status' => 1])
                ->whereDate('end_date', '>=', Carbon::today()->toDateString())
                ->orderBy('total_booking', 'desc')
                ->limit(6)
                ->get();
    }
    
    // get upcomming events
    public function get_upcomming_events()
    {
        return  Event::leftJoin("categories", "categories.id", '=', "events.category_id")
                    ->select(["events.*", "categories.name as category_name"])
                    ->whereDate('start_date', '!=', Carbon::now()->format('Y-m-d'))
                    ->whereDate('start_date', '>', Carbon::now()->format('Y-m-d'))
                    ->selectRaw("(SELECT CN.country_name FROM countries CN WHERE CN.id = events.country_id) country_name")
                    ->where(['events.publish' => 1, 'events.status' => 1, 'categories.status' => 1])
                    ->whereDate('end_date', '>', Carbon::today()->toDateString())
                    ->orderBy('start_date')
                    ->limit(6)
                    ->get();

    }

    // get cities events
    public function get_cities_events()
    {
        $mode           = config('database.connections.mysql.strict');

        $table          = 'events'; 
        $query          = DB::table($table);

        if(!$mode)
        {
            // safe mode is off
            $select = array(
                            "city",
                            "poster",
                            DB::raw("COUNT(*) AS cities"),
                        );
        }
        else
        {
            // safe mode is on
            $select = array(
                            "city",
                            DB::raw("ANY_VALUE(poster) AS poster"),
                            DB::raw("COUNT(*) AS cities"),
                        );
        }

        $query->select($select)
                ->where(['publish' => 1, 'status' => 1]);
                
                        
        // if hide expired events is on
        if(!empty(setting('booking.hide_expire_events')))
        {
            $today  = \Carbon\carbon::now(setting('regional.timezone_default'))->format('Y-m-d');    
            $query->whereRaw('(IF(events.repetitive = 1, events.end_date >= "'.$today.'", events.start_date >= "'.$today.'"))');
            
        }
        
        $result = $query->where(['events.publish' => 1, 'events.status' => 1])->groupBy('city')
                        ->orderBy('cities', 'DESC')
                        ->limit(6)->get();
                        
        return to_array($result);
    }

   
    // get customers
    public function get_customers($search = null)
    {
        $query = DB::table('users'); 
        $query->select('name', 'id')
                ->where('role_id', 2);
        if(!empty($search))
        {
            $query
            ->where(function ($query) use($search) {
                $query->where('name','LIKE',"%{$search}%")
                      ->orWhere('email','LIKE',"%{$search}%");
            });
        }   
        $result = $query->limit(10)->get();
        return to_array($result);
    }

    
    // only admin can delete event  
    public function delete_event($params = [])
    {
        return Event::where(['id' => $params['event_id']])
            ->delete();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // search customers
    public function search_customers($email = null)
    {
        $query = DB::table('users'); 
        $query->select('name', 'id', 'email')
                ->where('role_id', 2)
                ->where('email', $email);
        
        $result = $query->get();
        return to_array($result);
    }
 
}   
