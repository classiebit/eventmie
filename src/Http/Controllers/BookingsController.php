<?php           

namespace Classiebit\Eventmie\Http\Controllers;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

use Auth;

use Classiebit\Eventmie\Notifications\MailNotification;
use Classiebit\Eventmie\Models\Event;
use Classiebit\Eventmie\Models\Booking;
use Classiebit\Eventmie\Models\User;


class BookingsController extends Controller
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
        
        $this->middleware('auth')->except('get_customers');

        $this->event        = new Event;
        $this->booking      = new Booking;
        $this->user         = new User;
        $this->customer_id  = null;
    }

    // book tickets
    public function book_tickets(Request $request)
    {
        // 1. If admin is making booking then it will be for a customer
        $this->is_admin($request);

        // 2. General validation
        $data = $this->general_validation($request);
        if(!$data['status'])
            return error($data['error'], Response::HTTP_BAD_REQUEST);
        
        // 3. Timing & Date check 
        $pre_time_booking   =  $this->time_validation($data);    
        if(!$pre_time_booking['status'])
            return error($pre_time_booking['error'], Response::HTTP_BAD_REQUEST);

        // 4. Check if it's a valid customer
        $params  = ['customer_id' => $this->customer_id,];
        $customer   = $this->user->get_customer($params);
        if(empty($customer))
            return error($pre_time_booking['error'], Response::HTTP_BAD_REQUEST);     

        // 5. Create booking
        $booking                        = [];
        $booking['customer_id']         = $this->customer_id;
        $booking['customer_name']       = $customer['name'];
        $booking['customer_email']      = $customer['email'];
        $booking['event_id']            = $data['event']['id'];
        $booking['quantity']            = $data['quantity'];
        $booking['status']              = 1; 
        $booking['created_at']          = Carbon::now();
        $booking['updated_at']          = Carbon::now();
        $booking['event_title']         = $data['event']['title'];
        $booking['event_category']      = $data['event']['category_name'];
        $booking['event_start_date']    = $data['event']['start_date'];
        $booking['event_end_date']      = $data['event']['end_date'];
        $booking['event_start_time']    = $data['event']['start_time'];
        $booking['event_end_time']      = $data['event']['end_time'];
        $booking['price']               = 0;
        $booking['net_price']           = 0;
        $booking['order_number']        = time().rand(1,988);

        // Free events only
        $flag                           =  $this->booking->make_booking($booking);

        // in case of database failure
        if(empty($flag))
            return error('Database failure!', Response::HTTP_REQUEST_TIMEOUT);

        // 6. Send notifications
        $this->finish_booking($booking);

        // redirect no matter what so that it never turns backreturn response
        return response([
            'status'    => true,
            'url'       => Auth::user()->hasRole('admin') ? eventmie_url(config('eventmie.route.admin_prefix').'/bookings') : route('eventmie.mybookings_index'),
            'message'   => __('eventmie::em.congrats').' '.__('eventmie::em.booking').' '.__('eventmie::em.successful'),
        ], Response::HTTP_OK);
    }

    /**
     *  get customers
     */

     public function get_customers(Request $request)
     {
         $request->validate([
             'search'        => 'required|email|max:256',
         ]);
 
         $search     = $request->search;
         $customers  = $this->event->search_customers($search);
 
         if(empty($customers))
         {
             return response()->json(['status' => false, 'customers' => $customers]);    
         }
 
         foreach($customers as $key => $val)
             $customers[$key]->name = $val->name.'  ( '.$val->email.' )';
 
         return response()->json(['status' => true, 'customers' => $customers ]);
     }



    /* =================== PRIVATE METHODS ====================  */

    /** 
     * If admin is booking event
     * then it will be for a customer
    */
    private function is_admin(Request $request)
    {
        if(Auth::check())
        {
            // by default customer is Logged in user
            $this->customer_id = Auth::id();

            // if admin is creating booking
            // then customer id will the one selected from Customer dropdown
            if(Auth::user()->hasRole('admin'))
            {
                // 1. validate data
                $request->validate([
                    'customer_id'       => 'required|numeric|min:1|regex:^[1-9][0-9]*$^',
                ], [
                    'customer_id.*' => __('eventmie::em.customer').' '.__('eventmie::em.required'),
                ]);

                $this->customer_id = (int) $request->customer_id;
            }

            return true;
        }    
    }

    // validate user post data
    private function general_validation(Request $request)
    {
        $request->validate([
            'event_id'          => 'required|numeric|min:1|regex:^[1-9][0-9]*$^',
            'quantity'          => 'required|numeric|min:1|regex:^[1-9][0-9]*$^',
        ]);

        // check if selected event exists
        $event          = $this->event->get_event(null, $request->event_id);
        if(empty($event))
            return ['status' => false, 'error' =>  __('eventmie::em.event').' '.__('eventmie::em.not_found')];
        
        return [
            'status'            => true,
            'event_id'          => $request->event_id,
            'quantity'          => $request->quantity,
            'event'             => $event,
            'booking_date'      => $event['start_date'],
            'start_time'        => $event['start_time'],
            'end_time'          => $event['end_time'],
        ];

    }

    // pre booking time validation
    private function time_validation($params = [])
    {
        $booking_date           = $params['booking_date'];
        $start_time             = $params['start_time'];
        $start_time             = $params['end_time'];
        
        // booking date is event start date and it is less then today date then user can't book tickets
        $start_date             = Carbon::parse($booking_date.''.$start_time);
        $today_date             = Carbon::parse(Carbon::now());
 
        // 1.Booking date should not be less than today's date
        if($start_date < $today_date)
            return ['status' => false, 'error' => __('eventmie::em.event').' '.__('eventmie::em.ended')];
        
        return ['status' => true];    
    }

    // Finish booking
    private function finish_booking($booking = [])
    {
        // ====================== Notification ====================== 
        //send notification after bookings
        $mail['mail_message'] = "Email message body";
        $mail['greeting']     = "Greetings";
        $mail['mail_subject'] = "Booking Successfully";
        $mail['line']         = "Thank you for using our application!";
        $mail['n_type']       = "bookings";

        $notification_ids       = [1, $booking['customer_id']];
        
        $users = User::whereIn('id', $notification_ids)->get();
        \Notification::send($users, new MailNotification($mail));
        // ====================== Notification ====================== 
                
        return true;
    }
    
}
