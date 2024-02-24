<?php

namespace Classiebit\Eventmie\Http\Controllers\Auth;
use Facades\Classiebit\Eventmie\Eventmie;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;



use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;
class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = route('eventmie.events_index');
        
         // language change
        $this->middleware('common');
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
        
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                        ? redirect($this->redirectPath())
                        : Eventmie::view('eventmie::auth.verify');
    }

      /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
	public function verify(Request $request)
	{
    	if ($request->route('id') != $request->user()->getKey()) {
			throw new AuthorizationException();
		}

		if ($request->user()->markEmailAsVerified()) {
			event(new Verified($request->user()));
        }

        // redirect no matter what so that it never turns back
        $msg = __('eventmie::em.email_success');
        session()->flash('status', $msg);
		return redirect($this->redirectPath())->with('verified', true);
	}
    
     
}
