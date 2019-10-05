<?php

namespace Classiebit\Eventmie\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Event extends Model
{
    // exclude
    protected $guarded = [
        'id',
    ]; 

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
        if(empty($event_id))
        {
            return Event::create($params);
        }
        // if have event id then update     
        return Event::where(['id' => $event_id])->update($params);
    }

    
    /**
     * Get events with 
     * pagination and custom selection
     * 
     * @return string
     */
    public function events($params  = [])
    {   
        $query = DB::table('events'); 

        $query
        ->select("events.*");
        if(!empty($params['search']))    
        {
            $query
            ->whereRaw("( title LIKE '%".$params['search']."%' 
                OR venue LIKE '%".$params['search']."%' OR state LIKE '%".$params['search']."%' OR city LIKE '%".$params['search']."%')");
        }
            
        $query->selectRaw("(SELECT CN.country_name FROM countries CN WHERE CN.id = events.country_id) country_name")
                ->selectRaw("(SELECT  CT.name FROM categories CT WHERE CT.id = events.category_id) category_name");
        
        if(!empty($params['category_id']))
            $query ->where('category_id',$params['category_id']);

        if(!empty($params['start_date']) && !empty($params['end_date']))
        {
            $query ->where('start_date', '>=' , $params['start_date']);
            $query ->where('start_date', '<=' , $params['end_date']);
        }
        
        if(!empty($params['start_date']) && empty($params['end_date']))
            $query ->where('start_date', $params['start_date']);

        $query->where(["events.status" => 1, "events.publish" => 1]);

        // if hide expired events is on
        if(!empty(setting('booking.hide_expire_events')))
        {
            $today  = \Carbon\carbon::now(setting('regional.timezone_default'))->format('Y-m-d');    
            $query->whereRaw('(IF(events.repetitive = 1, events.end_date >= "'.$today.'", events.start_date >= "'.$today.'"))');
        }

        return $query->orderBy('events.start_date', 'ASC')
                    ->paginate(9);
    }
    
    // get top selling event
    public function get_top_selling_events()
    {
        return Event::select('events.*')->from('events')
            ->selectRaw("(SELECT SUM(BK.quantity) FROM bookings BK WHERE BK.event_id = events.id) total_booking")
            ->selectRaw("(SELECT CN.country_name FROM countries CN WHERE CN.id = events.country_id) country_name")
            ->selectRaw("(SELECT CT.name FROM categories CT WHERE CT.id = events.category_id) category_name")
            ->where(['publish' => 1, 'status' => 1])
            ->orderBy('total_booking', 'desc')
            ->limit(6)
            ->get();
    }
    
    // get upcomming events
    public function get_upcomming_events()
    {
        return  Event::select('events.*')
                    ->whereDate('start_date', '!=', Carbon::now()->format('Y-m-d'))
                    ->whereDate('start_date', '>', Carbon::now()->format('Y-m-d'))
                    ->selectRaw("(SELECT CN.country_name FROM countries CN WHERE CN.id = events.country_id) country_name")
                    ->selectRaw("(SELECT CT.name FROM categories CT WHERE CT.id = events.category_id) category_name")
                    ->where(['publish' => 1, 'status' => 1])
                    ->orderBy('start_date')
                    ->limit(6)
                    ->get();

    }

    // get customers
    public function get_customers($params = [])
    {
        return  DB::table('users')
                    ->select('name', 'id')
                    ->where('role_id', 2)
                    ->get()
                    ->toArray();
    }

    
    // only admin can delete event  
    public function delete_event($params = [])
    {
        return Event::where(['id' => $params['event_id']])
            ->delete();
    }

     
}
