<?php

namespace Classiebit\Eventmie\Http\Controllers;
use App\Http\Controllers\Controller; 
use Facades\Classiebit\Eventmie\Eventmie;
use Classiebit\Eventmie\Notifications\MailNotification;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Classiebit\Eventmie\Models\Contact;
use Classiebit\Eventmie\Models\User;


class ContactController extends Controller
{

    
    public function __construct()
    {
        // language change
        $this->middleware('common');
    
        $this->contact   = new Contact;
    }


    public function index()
    {
        return Eventmie::view('eventmie::contact');
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
            return redirect()->back()->with('msg', __('eventmie::em.message_sent_fail')); 
        }
        
        // ====================== Notification ====================== 
        //send notification after bookings
        $mail['mail_message'] = "Email message body";
        $mail['greeting']     = "Greetings";
        $mail['mail_subject'] = "Thank you for contacting us";
        $mail['line']         = "We will get back to you soon!";
        $mail['n_type']       = "contact";
        
        // send mail notification on any email id
        $user           = new User();
        $user->email    = $request->email;
        
        \Notification::send($user, new MailNotification($mail));
        // ====================== Notification ====================== 
        
        return redirect()->back()->with('msg', __('eventmie::em.message_sent')); 
    }
}    