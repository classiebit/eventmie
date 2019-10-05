<?php

namespace Classiebit\Eventmie\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

use Classiebit\Eventmie\Models\User;

class Booking extends Model
{
    protected $guarded = [
        'id'
    ];

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
        return Booking::select('bookings.*')
                ->from('bookings')
                ->selectRaw("(SELECT E.slug FROM events E WHERE E.id = bookings.event_id) event_slug")
                ->where(['customer_id' => $params['customer_id'] ])
                ->orderBy('id', 'desc')
                ->paginate(10);
    }

}
