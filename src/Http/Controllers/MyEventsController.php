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
use Classiebit\Eventmie\Models\Booking;
use Classiebit\Eventmie\Models\Event;
use Classiebit\Eventmie\Models\User;
use Classiebit\Eventmie\Models\Category;
use Classiebit\Eventmie\Models\Country;
use Classiebit\Eventmie\Notifications\MailNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Throwable;
use DB;
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
        $this->event    = new Event;
        $this->category = new Category;
        $this->country  = new Country;
        $this->booking  = new Booking;
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
    public function form($slug = null, $view = 'eventmie::events.form', $extra = [])
    {
        
        $event  = [];
        
        // get event by event_slug
        if($slug)
        {
            $event  = $this->event->get_event($slug);
        }
    
        return Eventmie::view($view, compact('event', 'extra'));
    }

    // create event
    public function store(Request $request)
    {
        // 1. validate data
        $request->validate([
            'title'             => 'required|max:256',
            'slug'              => 'required|max:512',
            'category_id'       => 'required|numeric|min:1|regex:^[1-9][0-9]*$^',
            'description'       => 'required',
            'faq'               => 'nullable',
        ], [
            'category_id.*' => __('eventmie::em.category').' '.__('eventmie::em.required')
        ]);

        
        $result             = (object) [];
        $result->title      = null;
        $result->slug       = null;
        
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
            ]);
        }
        
        // slug is not equal to before slug then apply unique column rule    
        if($result->slug != $request->slug)
        {
            $request->validate([
                'slug'             => 'unique:events,slug',
            ]);
        }

        $params = [
            "title"         => $request->title,
            "slug"          => $this->slugify($request->slug),
            "description"   => $request->description,
            "faq"           => $request->faq,
            "category_id"   => $request->category_id,
        ];

        
        $event    = $this->event->save_event($params, $request->event_id);
        
        if(empty($event))
            return error(__('eventmie::em.event_not_created'), Response::HTTP_BAD_REQUEST );

        // ====================== Notification ====================== 
        //send notification after bookings
        $msg[]                  = __('eventmie::em.event').' - '.$event->title;
        $extra_lines            = $msg;

        $mail['mail_subject']   = __('eventmie::em.event_created');
        $mail['mail_message']   = __('eventmie::em.event_info');
        $mail['action_title']   = __('eventmie::em.manage_events');
        $mail['action_url']     = route('eventmie.myevents_index');
        $mail['n_type']         = "events";

        $notification_ids       = [1];
        
        $users = User::whereIn('id', $notification_ids)->get();
        try {
            \Notification::locale(\App::getLocale())->send($users, new MailNotification($mail, $extra_lines));
        } catch (\Throwable $th) {}
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

    // crate media of event
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
        {
            return error('access denied', Response::HTTP_BAD_REQUEST );
        }
    
        // for multiple image
        $path = 'events/'.Carbon::now()->format('FY').'/';

        // for thumbnail
        if(!empty($_REQUEST['thumbnail'])) 
        { 
            $params  = [
                'image'  => $_REQUEST['thumbnail'],
                'path'   => 'events',
                'width'  => 854,
                'height' => 480,  
            ];
            $thumbnail   = $this->upload_base64_image($params);
        }

        if(!empty($_REQUEST['poster'])) 
        {
            $params  = [
                'image'  => $_REQUEST['poster'],
                'path'   => 'events',
                'width'  => 1280,
                'height' => 720,  
            ];

            $poster   = $this->upload_base64_image($params);
        }
    
        // for image
        if($request->hasfile('images')) 
        { 
            // if have  image and database have images no images this event then apply this rule 
            $request->validate([
                'images'        => 'required',
                'images.*'      => 'mimes:jpeg,png,jpg,gif,svg',
            ]); 
        
            $files = $request->file('images');
    
            foreach($files as  $key => $file)
            {
                $extension       = $file->getClientOriginalExtension(); // getting image extension
                $image[$key]     = time().rand(1,988).'.'.'webp';

                $image_resize    = Image::make($file)->encode('webp', 90)->resize(854, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            
                // if directory not exist then create directiory
                if (! File::exists(storage_path('/app/public/').$path)) {
                    File::makeDirectory(storage_path('/app/public/').$path, 0775, true);
                }
                
                $image_resize->save(storage_path('/app/public/'.$path.$image[$key]));
                $images[$key]    = $path.$image[$key];
            }
        }
        
        $params = [
            "thumbnail"     => !empty($thumbnail) ? $path.$thumbnail : null ,
            "poster"        => !empty($poster) ? $path.$poster : null,
        ];  

        // if images uploaded
        if(!empty($images))
        {
            if(!empty($result->images))
            {
                $exiting_images = json_decode($result->images, true);

                $images = array_merge($images, $exiting_images);
            }

            $params["images"] = json_encode(array_values($images));

        }    
        
        $status   = $this->event->save_event($params, $request->event_id);

        if(empty($status))
        {
            return error('Database failure!', Response::HTTP_BAD_REQUEST );
        }

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
            "country_id"    => $request->country_id,
            "venue"         => $request->venue,
            "address"       => $request->address,
            "city"          => $request->city,
            "zipcode"       => $request->zipcode,
            "state"         => $request->state,
        ];

        // check this event id have login user or not
        $event    = $this->event->get_user_event($request->event_id);
        if(empty($event))
            return error('access denied', Response::HTTP_BAD_REQUEST );

        $location   = $this->event->save_event($params, $request->event_id);
        if(empty($location))
        {
            return error('Database failure!', Response::HTTP_BAD_REQUEST );
        }

        // get update event
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
        {
            return error('access denied!', Response::HTTP_BAD_REQUEST );
        }

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
            'meta_title'             => 'max:256',
            'meta_keywords'          => 'max:256',
            'meta_description'       => 'max:512',
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
        {
            return error('Database failure!', Response::HTTP_BAD_REQUEST );
        }

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
        {
            return error('access denied!', Response::HTTP_BAD_REQUEST );
        }

        // check all step is completed or not 
        $is_publishable     =  json_decode($event->is_publishable, true);

        if(count($is_publishable) != 4)
            return error(__('eventmie::em.please_complete_steps'), Response::HTTP_BAD_REQUEST );

        // do not unpublish in demo mode
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
        {
            return error('Database failure!', Response::HTTP_BAD_REQUEST );
        }

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
        {
            return error('access denied!', Response::HTTP_BAD_REQUEST );
        }

        return response()->json(['status' => true, 'event' => $event ]);

    }

      
    /** 
     * Get countries list
    */
    public function countries()
    {
        $countries = $this->country->get_countries();

        if(empty($countries))
        {
            return response()->json(['status' => false]);    
        }
        return response()->json(['status' => true, 'countries' => $countries ]);
        
    }

    
    /**
     *   only admin can delete event
     */
    public function delete_event($slug = null)
    {   
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
        {
            return redirect()->route('eventmie.events');
        }

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
        {
            return error('Event Could Not Deleted!', Response::HTTP_BAD_REQUEST );   
        }

        $msg = __('eventmie::em.event_deleted');
        
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
    protected function upload_base64_image($params = [])
    {
        if(!empty($params['image'])) 
        { 
            $image           = base64_encode(file_get_contents($params['image']));
            $image           = str_replace('data:image/png;base64,', '', $image);
            $image           = str_replace(' ', '+', $image);

            if(class_exists('\Str'))
                $filename        = time().\Str::random(10).'.'.'webp';
            else
                $filename        = time().str_random(10).'.'.'webp';
            
            $path            = '/storage/'.$params['path'].'/'.Carbon::now()->format('FY').'/';
            $image_resize    = Image::make(base64_decode($image))->encode('webp', 90)->resize($params['width'], $params['height']);

            // first check if directory exists or not
            if (! File::exists(public_path().$path)) {
                File::makeDirectory(public_path().$path, 0775, true);
            }
    
            $image_resize->save(public_path($path . $filename));
            
            return  $filename;
        }
    } 

    /**
     *  prepare_single_event
     */

    protected function prepare_single_event(Request $request)
    {
        $event = Event::where(['id' => $request->event_id])->first();
        
        // start validation will not apply if database start_date and request start is same
        if($event->start_date != $request->start_date)
        {
            $request->validate([
                'start_date'        => 'required|date|after_or_equal:today',
            ]);
           
        }

        // 1. validate data
        $request->validate([
            'end_date'          => 'required|date|after_or_equal:start_date',
            'start_time'        => 'required|date_format:H:i:s',
            'end_time'          => 'required|date_format:H:i:s',
        ]);

        $data = [
            "start_date"        => serverTimezone($request->start_date.' '.$request->start_time, 'Y-m-d H:i:s', 'Y-m-d'),
            "start_time"        => serverTimezone($request->start_date.' '.$request->start_time, 'Y-m-d H:i:s', 'H:i:s'),
            "end_date"          => serverTimezone($request->end_date.' '.$request->end_time, 'Y-m-d H:i:s', 'Y-m-d'),
            "end_time"          => serverTimezone($request->end_date.' '.$request->end_time, 'Y-m-d H:i:s', 'H:i:s'),
        ];

        return [
            'status'    => true, 
            'data'      => $data
        ];
    }

    // complete specific step
    protected function complete_step($is_publishable = [], $type = 'detail', $event_id = null)
    {
        if(!empty($is_publishable))
            $is_publishable             = json_decode($is_publishable, true);

        $is_publishable[$type]      = 1;
        
        // save is_publishable
        $params     = ['is_publishable' => json_encode($is_publishable)];
        $status     = $this->event->save_event($params, $event_id);

        return true;
    }

    /**
     *  delete image
     */

    public function delete_image(Request $request)
    {
        // 1. validate data
        $request->validate([
            'event_id'             => 'required|numeric|min:1|regex:^[1-9][0-9]*$^',
            'image'                => 'required|string',
            
        ]);

        $event      = $this->event->get_user_event($request->event_id);

        if(empty($event))
        {
            return error('access denied', Response::HTTP_BAD_REQUEST );
        }

        $images     = json_decode($event->images);
    
        $filtered_images = [];
        foreach($images as $key => $val)
        {
            if($val != $request->image)
                $filtered_images[$key] = $val;
        }
        
        $params = [
            'images' =>  !empty($filtered_images) ? json_encode(array_values($filtered_images)) : null, 
        ];

        $event   = $this->event->save_event($params, $request->event_id);

        if(empty($event))
        {
            return error('Database failure!', Response::HTTP_BAD_REQUEST );
        }


        // get media  related event_id who have created now
        return response()->json(['images' => $event, 'status' => true]);

    }

    // Make event title -> slug properly
    protected function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        
        // trim
        $text = trim($text, '-');

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

}