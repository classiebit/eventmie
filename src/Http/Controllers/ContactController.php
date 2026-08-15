<?php

namespace Classiebit\Eventmie\Http\Controllers;

use Carbon\Carbon;
use Classiebit\Eventmie\Models\Contact;
use Classiebit\Eventmie\Models\User;
use Classiebit\Eventmie\Notifications\MailNotification;
use Classiebit\Eventmie\Support\SafeMail;
use Facades\Classiebit\Eventmie\Eventmie;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ContactController extends Controller
{
    public function __construct()
    {
        // language change
        $this->middleware('common');

        $this->contact = new Contact;
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
            'name' => 'required|min:5|max:256',
            'email' => 'required|email|max:255',
            'title' => 'required|min:3|max:256',
            'message' => 'required|min:2|max:1000',
        ]);

        $email = SafeMail::sanitize($request->email);
        if ($email === null) {
            return redirect()->back()->withErrors(['email' => __('validation.email', ['attribute' => 'email'])]);
        }

        $data = [
            'name' => strip_tags((string) $request->name),
            'email' => $email,
            'title' => strip_tags((string) $request->title),
            'message' => strip_tags((string) $request->message),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $contact = $this->contact->store_contact($data);

        if (empty($contact)) {
            return redirect()->back()->with('msg', __('eventmie::em.message_sent_fail'));
        }

        // ====================== Notification ======================
        // send notification after bookings
        $msg[] = __('eventmie::em.name').' - '.$contact->name;
        $msg[] = __('eventmie::em.email').' - '.$contact->email;
        $msg[] = __('eventmie::em.title').' - '.$contact->title;
        $msg[] = __('eventmie::em.message').' - '.$contact->message;
        $extra_lines = $msg;

        $mail['mail_subject'] = __('eventmie::em.message_sent');
        $mail['mail_message'] = __('eventmie::em.get_tickets');
        $mail['action_title'] = __('eventmie::em.view').' '.__('eventmie::em.all').' '.__('eventmie::em.events');
        $mail['action_url'] = route('eventmie.events_index');
        $mail['n_type'] = 'contact';

        $admin = User::whereId(1)->first();
        $recipients = array_values(array_filter([
            $admin?->email,
            $contact->email,
        ]));

        try {
            if (! empty($recipients)) {
                \Notification::route('mail', $recipients)->notify(new MailNotification($mail, $extra_lines));
            }
        } catch (\Throwable $th) {
        }
        // ====================== Notification ======================

        return redirect()->back()->with('msg', __('eventmie::em.message_sent'));
    }
}
