<?php

namespace Classiebit\Eventmie\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

use Classiebit\Eventmie\Models\User;
use Illuminate\Database\Eloquent\Builder;

class Booking extends Model
{
    protected $guarded = [];

    /**
     * Table used
    */
    private $tb                 = 'bookings';
    
    // make booking
    public function make_booking($params = [])
    {
        return Booking::create($params);
    }    

    // get booking for customer
    public function get_my_bookings($params = [])
    {   
        return Booking::select('bookings.*', 'E.slug as event_slug', 'E.thumbnail as event_thumbnail')
                ->from('bookings')
                ->leftJoin('events as E', 'E.id', '=', 'bookings.event_id')
                ->where(['bookings.customer_id' => $params['customer_id'] ])
                ->orderBy('bookings.id', 'desc')
                ->paginate(20);
    }

}
