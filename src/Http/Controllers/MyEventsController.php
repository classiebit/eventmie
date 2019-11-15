<?php

namespace Classiebit\Eventmie\Http\Controllers;
use App\Http\Controllers\Controller; 
use Facades\Classiebit\Eventmie\Eventmie;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;

use Auth;
use Redirect;
use File;
use Classiebit\Eventmie\Notifications\MailNotification;

use Classiebit\Eventmie\Models\Event;
use Classiebit\Eventmie\Models\User;
use Classiebit\Eventmie\Models\Category;
use Classiebit\Eventmie\Models\Country;

class MyEventsController extends Controller
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

        // exclude routes
        $this->middleware('admin');

        $this->event    = new Event;
        $this->category = new Category;
        $this->country  = new Country;
    }

    /**
     *  Manage events list
     */
    public function index()
    {
        return redirect()->route('voyager.events.index');
    }

    /**
     * Create-edit event
     *
     * @return array
     */
    public function form($slug = null)
    {
        $event  = [];
        
        // get event by event_slug in case of editing event
        if($slug)
            $event = $this->event->get_event($slug);
    
        return Eventmie::view('eventmie::events.form', compact('event'));
    }

    /**
     * Init Event creation process
     */
    public function store(Request $request)
    {
        // 1. validate data
        $request->validate([
            'title'             => 'required|max:256',
            'slug'              => 'required|max:512',
            'category_id'       => 'required|numeric|min:1|regex:^[1-9][0-9]*$^',
            'description'       => 'required',
            'faq'               => 'required',
        ], [
            'category_id.*' => __('eventmie::em.category').' '.__('eventmie::em.required')
        ]);

        
        $result             = (object) [];
        $result->title      = null;
        
        // in case of edit
        if(!empty($request->event_id))
        {
            $request->validate([
                'event_id'       => 'required|numeric|min:1|regex:^[1-9][0-9]*$^',
            ]);

            // check this event id have login user relationship
            $result      = (object) $this->event->get_user_event($request->event_id);
        
            if(empty($result))
                return error('access denied', Response::HTTP_BAD_REQUEST );
        }
        
        // title is not equal to before title then apply unique column rule    
        if($result->title != $request->title)
        {
            $request->validate([
                'title'             => 'unique:events,title',
                'slug'              => 'unique:events,slug'
            ]);
        }

        $params = [
            "title"         => $request->title,
            "slug"          => $request->slug,
            "description"   => $request->description,
            "faq"           => $request->faq,
            "category_id"   => $request->category_id,
        ];
        
        $event    = $this->event->save_event($params, $request->event_id);
        
        if(empty($event))
            return error(__('eventmie::em.event').' '.__('eventmie::em.could_not').' '.__('eventmie::em.created'), Response::HTTP_BAD_REQUEST );

        
        // ====================== Notification ====================== 
        //send notification after bookings
        $mail['mail_message'] = "Email message body";
        $mail['greeting']     = "Greetings";
        $mail['mail_subject'] = "Event Created Successfully";
        $mail['line']         = "Thank you for using our application!";
        $mail['n_type']       = "events";

        $notification_ids       = [1];
        
        $users = User::whereIn('id', $notification_ids)->get();
        \Notification::send($users, new MailNotification($mail));
        // ====================== Notification ======================     
        
        
        // in case of create
        if(empty($request->event_id))
        {
            // set step complete
            $this->complete_step($event->is_publishable, 'detail', $event->id);
            return response()->json(['status' => true, 'id' => $event->id, 'slug' => $event->slug ]);
        }    
        
        // update event in case of edit
        $event      = $this->event->get_user_event($request->event_id);
        return response()->json(['status' => true, 'slug' => $event->slug]);    
    }

    /** 
     * Store Media
    */
    public function store_media(Request $request)
    {
        $images    = [];
        $poster    = null;
        $thumbnail = null;

        // 1. validate data
        $request->validate([
            'event_id'      => 'required|numeric|min:1|regex:^[1-9][0-9]*$^',
            'thumbnail'     => 'required',
            'poster'        => 'required',
        ]);

        $result              = [];
        // check this event id have login user or not
        $result    = $this->event->get_user_event($request->event_id);

        if(empty($result))
            return error('access denied', Response::HTTP_BAD_REQUEST );
    
        // for multiple image
        $path = 'events/'.Carbon::now()->format('FY').'/';

        // for thumbnail
        if(!empty($_REQUEST['thumbnail'])) 
        { 
            $params  = [
                'image'  => $_REQUEST['thumbnail'],
                'path'   => 'events',
                'width'  => 512,
                'height' => 512,  
            ];
            $thumbnail   = $this->upload_base64_image($params);
        }

        if(!empty($_REQUEST['poster'])) 
        {
            $params  = [
                'image'  => $_REQUEST['poster'],
                'path'   => 'events',
                'width'  => 1920,
                'height' => 1080,  
            ];

            $poster   = $this->upload_base64_image($params);
        }
    
        // for image
        if($request->hasfile('images')) 
        { 
            // if have  image and database have images no images this event then apply this rule 
            $request->validate([
                'images'        => 'required',
                'images.*'      => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]); 
        
            $files = $request->file('images');
    
            foreach($files as  $key => $file)
            {
                $extension       = $file->getClientOriginalExtension(); // getting image extension
                $image[$key]     = time().rand(1,988).'.'.$extension;
                $file->storeAs('public/'.$path, $image[$key]);
                
                $images[$key]    = $path.$image[$key];
            }
        }
        
        $params = [
            "thumbnail"     => !empty($thumbnail) ? $path.$thumbnail : null ,
            "poster"        => !empty($poster) ? $path.$poster : null,
        ];  

        // if images uploaded
        if(!empty($images))
            $params["images"] = json_encode($images);
        
        $status   = $this->event->save_event($params, $request->event_id);

        if(empty($status))
            return error('Database failure!', Response::HTTP_BAD_REQUEST );

        // get media  related event_id who have created now
        $images   = $this->event->get_user_event($request->event_id);

        // set step complete
        $this->complete_step($images->is_publishable, 'media', $request->event_id);

        return response()->json(['images' => $images, 'status' => true]);
    }

    /** 
     * Store Location
    */
    public function store_location(Request $request)
    {
        // 1. validate data
        $request->validate([
            // 'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'venue'             => 'required|max:256',
            'country_id'        => 'required|numeric|min:1|regex:^[1-9][0-9]*$^',
            'address'           => 'required|max:512',
            'city'              => 'required|max:256',
            'state'             => 'required|max:256',
            'zipcode'           => 'required|max:64',
            'event_id'          => 'required|numeric|min:1|regex:^[1-9][0-9]*$^',
        ]);

        $params = [
            "venue"         => $request->venue,
            "address"       => $request->address,
            "city"          => $request->city,
            "zipcode"       => $request->zipcode,
            "country_id"    => $request->country_id,
            "state"         => $request->state,
        ];

        // check this event id have login user or not
        $event    = $this->event->get_user_event($request->event_id);
        if(empty($event))
            return error('access denied', Response::HTTP_BAD_REQUEST );

        $location   = $this->event->save_event($params, $request->event_id);
        if(empty($location))
            return error('Database failure!', Response::HTTP_BAD_REQUEST );

        // get updated event
        $event    = $this->event->get_user_event($request->event_id);

        // set step complete
        $this->complete_step($event->is_publishable, 'location', $request->event_id);
        
        return response()->json(['status' => true, 'event' => $event]);
    }    

    /** 
     * Store Timings
    */
    public function store_timing(Request $request)
    {   
        $request->validate([
            'event_id'          => 'required',
        ]); 
        
        $event    = $this->event->get_user_event($request->event_id);
        if(empty($event))
            return error('access denied!', Response::HTTP_BAD_REQUEST );

        $single_event       = $this->prepare_single_event($request);
        if(!$single_event['status'])
            return error($single_event['error'], Response::HTTP_BAD_REQUEST );

        $data                   = $single_event['data'];
        $event_timing           = $this->event->save_event($data, $request->event_id);

        if(empty($event_timing))
            return error('Database failure!', Response::HTTP_BAD_REQUEST);

        // get updated event
        $event    = $this->event->get_user_event($request->event_id);

        // set step complete
        $this->complete_step($event->is_publishable, 'timing', $request->event_id);

        return response()->json(['status' => true]);
    }

    /** 
     * Store SEO
    */
    public function store_seo(Request $request)
    {
        // 1. validate data
        $request->validate([
            'meta_title'             => 'required|max:256',
            'meta_keywords'          => 'max:256',
            'meta_description'       => 'required|max:512',
        ]);

        $params = [
            "meta_title"         => $request->meta_title,
            "meta_keywords"      => $request->meta_keywords,
            "meta_description"   => $request->meta_description,
        ];

        // check this event id have login user or not
        $event    = $this->event->get_user_event($request->event_id);
        if(empty($event))
            return error('access denied', Response::HTTP_BAD_REQUEST );

        $seo   = $this->event->save_event($params, $request->event_id);
        if(empty($seo))
            return error('Database failure!', Response::HTTP_BAD_REQUEST );

        // get updated event
        $event    = $this->event->get_user_event($request->event_id);
        
        return response()->json(['status' => true, 'event' => $event]);
    }   

    /** 
     * Publish Event
     * after completing all steps
    */
    public function event_publish(Request $request)
    {
        $request->validate([
            'event_id'       => 'required|numeric|min:1|regex:^[1-9][0-9]*$^',
        ]);
        
        // check event is valid or not
        $event    = $this->event->get_user_event($request->event_id);

        if(empty($event))
            return error('access denied!', Response::HTTP_BAD_REQUEST );

        // check all step is completed or not 
        $is_publishable     =  json_decode($event->is_publishable, true);

        if(count($is_publishable) != 4)
            return error(__('eventmie::em.please_complete_steps'), Response::HTTP_BAD_REQUEST );

        // demo mode restrictions
        if(config('voyager.demo_mode'))
        {
            if($event->publish)
                return error('Demo mode', Response::HTTP_BAD_REQUEST );
        }
        
        $params  = [
            'publish'      => $event->publish == 1 ? 0 : 1,
        ];

        $publish_event    = $this->event->save_event($params, $request->event_id);

        if(empty($publish_event))
            return error('Database failure!', Response::HTTP_BAD_REQUEST );

        return response()->json(['status' => true ]);

    }

    // get event
    public function get_user_event(Request $request)
    {
        $request->validate([
            'event_id'        => 'required',
        ]);
        
        // check event is valid or not
        $event    = $this->event->get_user_event($request->event_id);

        if(empty($event))
            return error('access denied!', Response::HTTP_BAD_REQUEST );

        return response()->json(['status' => true, 'event' => $event ]);
    }

      
    /** 
     * Get countries list
    */
    public function countries()
    {
        $countries = $this->country->get_countries();

        if(empty($countries))
            return response()->json(['status' => false]);    

        return response()->json(['status' => true, 'countries' => $countries ]);
    }

    /**
     * Delete Event (from Admin panel)
    */
    public function delete_event($slug = null)
    {   
        // demo mode restrictions
        if(config('voyager.demo_mode'))
        {
            return redirect()
            ->route("voyager.events.index")
            ->with([
                'message'    => 'Demo mode',
                'alert-type' => 'info',
            ]);
        }

        // only admin can delete event
        if(Auth::check() && !Auth::user()->hasRole('admin'))
            return redirect()->route('eventmie.events');

        // get event by event_slug
        if(empty($slug))
            return error('Event Not Found!', Response::HTTP_BAD_REQUEST );

        $event = $this->event->get_event($slug);
        if(empty($event))
            return error('Event Not Found!', Response::HTTP_BAD_REQUEST );

        $params    = [
            'event_id'     => $event->id,
        ];

        $delete_event     = $this->event->delete_event($params);
        if(empty($delete_event))
            return error('Event Could Not Deleted!', Response::HTTP_BAD_REQUEST );   

        $msg = __('eventmie::em.event').' '.__('eventmie::em.deleted').' '.__('eventmie::em.successfully');
        
        // redirect back to admin panel
        return redirect()
        ->route("voyager.events.index")
        ->with([
            'message'    => $msg,
            'alert-type' => 'success',
        ]); 
    }

    
    /* ==================== Private fucntions ==================== */
    
    /**
     *  Upload base64 image 
     */
    private function upload_base64_image($params = [])
    {
        if(!empty($params['image'])) 
        { 
            $image           = base64_encode(file_get_contents($params['image']));
            $image           = str_replace('data:image/png;base64,', '', $image);
            $image           = str_replace(' ', '+', $image);

            if(class_exists('\Str'))
                $filename        = time().\Str::random(10).'.'.'jpg';
            else
                $filename        = time().str_random(10).'.'.'jpg';

            $path            = '/storage/'.$params['path'].'/'.Carbon::now()->format('FY').'/';
            $image_resize    = Image::make(base64_decode($image))->resize($params['width'], $params['height']);

            // first check if directory exists or not
            
            if (! File::exists(public_path().$path)) {
                File::makeDirectory(public_path().$path);
            }
    
            $image_resize->save(public_path($path . $filename));
            
            return  $filename;
        }
    } 

    /**
     *  prepare_single_event
     */
    private function prepare_single_event(Request $request)
    {
        // 1. validate data
        $request->validate([
            'start_date'        => 'required|date|after_or_equal:tomorrow',
            'end_date'          => 'required|date|after_or_equal:start_date',
            'start_time'        => 'required|date_format:H:i:s',
            'end_time'          => 'required|date_format:H:i:s|after:start_time',
        ]);

        $data = [
            "start_date"        => $request->start_date,
            "start_time"        => $request->start_time,
            "end_date"          => $request->end_date,
            "end_time"          => $request->end_time,
        ];

        return [
            'status'    => true, 
            'data'      => $data
        ];
    }

    // complete specific step
    private function complete_step($is_publishable = [], $type = 'detail', $event_id = null)
    {
        if(!empty($is_publishable))
            $is_publishable             = json_decode($is_publishable, true);

        $is_publishable[$type]      = 1;
        
        // save is_publishable
        $params     = ['is_publishable' => json_encode($is_publishable)];
        $status     = $this->event->save_event($params, $event_id);

        return true;
    }
}