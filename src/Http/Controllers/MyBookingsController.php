<?php

namespace Classiebit\Eventmie\Http\Controllers;
use App\Http\Controllers\Controller; 
use Facades\Classiebit\Eventmie\Eventmie;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;

use Auth;

use Classiebit\Eventmie\Models\Event;
use Classiebit\Eventmie\Models\Category;
use Classiebit\Eventmie\Models\Country;
use Classiebit\Eventmie\Models\Booking;
use Classiebit\Eventmie\Models\User;
use Classiebit\Eventmie\Notifications\MailNotification;

class MybookingsController extends Controller
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

        $this->middleware(['customer']);

        $this->event        = new Event;
        $this->booking      = new Booking;
    }
    
    /**
     * Customer bookings
     *
     * @return array
     */
    public function index($view = 'eventmie::bookings.customer_bookings', $extra = [])
    {
        // get prifex from eventmie config
        $path = false;
        if(!empty(config('eventmie.route.prefix')))
            $path = config('eventmie.route.prefix');

        // if have booking email data then send booking notification
        $is_success = 1;    
        return Eventmie::view($view, compact('path', 'is_success','extra'));
    }

    /**
     * Get customer bookings
     *  */
    public function mybookings()
    {
        $params     = [
            'customer_id'  => Auth::id(),
        ];

        $bookings    = $this->booking->get_my_bookings($params);

        // check expired booking
        // event end_date <= today_date
        foreach($bookings as $key => $val) 
            $val->expired              = $val->event_end_date <= Carbon::now()->format('Y-m-d') ? 1 : 0;
        
        return response([
            'bookings'  => $bookings->jsonSerialize(),
        ], Response::HTTP_OK);

    }


}
