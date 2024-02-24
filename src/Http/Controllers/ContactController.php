<?php

namespace Classiebit\Eventmie\Http\Controllers;
use Facades\Classiebit\Eventmie\Eventmie;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Classiebit\Eventmie\Models\Contact;
use Classiebit\Eventmie\Models\User;

use Classiebit\Eventmie\Notifications\MailNotification;


class ContactController extends Controller
{

    
    public function __construct()
    {
        // language change
        $this->middleware('common');
    
        $this->contact   = new Contact;
    }


    // get featured events
    public function index($view = 'eventmie::contact', $extra = [])
    {
        return Eventmie::view($view, compact('extra'));
    }

    // contact save
    public function store_contact(Request $request)
    {
        $request->validate([
            'name'           => 'required|min:5|max:256',
            'email'          => 'required|email',
            'title'          => 'required|min:3|max:256',
            'message'        => 'required|min:2|max:1000',
        ]);

        $data = [
            'name'          => $request->name,
            'email'         => $request->email,
            'title'         => $request->title,
            'message'       => $request->message,
            'created_at'    => \Carbon\Carbon::now(),
            'updated_at'    => \Carbon\Carbon::now(),
        ];
        
        $contact     = $this->contact->store_contact($data);
        
        if(empty($contact))
        {
            return redirect()->back()->with('msg', __('eventmie-pro::em.message_sent_fail')); 
        }
        
        // ====================== Notification ====================== 
        //send notification after bookings
        $msg[]                  = __('eventmie-pro::em.name').' - '.$contact->name;
        $msg[]                  = __('eventmie-pro::em.email').' - '.$contact->email;
        $msg[]                  = __('eventmie-pro::em.title').' - '.$contact->title;
        $msg[]                  = __('eventmie-pro::em.message').' - '.$contact->message;
        $extra_lines            = $msg;

        $mail['mail_subject']   = __('eventmie-pro::em.message_sent');
        $mail['mail_message']   = __('eventmie-pro::em.get_tickets');
        $mail['action_title']   = __('eventmie-pro::em.view').' '.__('eventmie-pro::em.all').' '.__('eventmie-pro::em.events');
        $mail['action_url']     = route('eventmie.events_index');
        $mail['n_type']         = "contact";
        
        // notification for
        $notification_ids       = [
            User::whereId(1)->first(), // admin
            $contact->email
        ];
        
        // $users = User::whereIn('id', $notification_ids)->get();

        $users = $notification_ids;

        try {
            \Notification::route('mail', $users)->notify(new MailNotification($mail, $extra_lines));
        } catch (\Throwable $th) {}
        // ====================== Notification ====================== 
        
        return redirect()->back()->with('msg', __('eventmie-pro::em.message_sent')); 
    }
}    