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
    public function index()
    {
        return Eventmie::view('eventmie::bookings.customer_bookings');    
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

        if($bookings->isEmpty())
            return error(__('eventmie::em.booking').' '.__('eventmie::em.not_found'), Response::HTTP_BAD_REQUEST );
        
        return response([
            'bookings'  => $bookings->jsonSerialize(),
        ], Response::HTTP_OK);

    }


}
