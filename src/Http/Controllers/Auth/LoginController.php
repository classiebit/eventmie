<?php

namespace Classiebit\Eventmie\Http\Controllers\Auth;
use Facades\Classiebit\Eventmie\Eventmie;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Classiebit\Eventmie\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
         // language change
        $this->middleware('common');
        $this->middleware('guest')->except('logout');
        $this->redirectTo = !empty(config('eventmie.route.prefix')) ? config('eventmie.route.prefix') : '/';
    }


    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        
        if (\Auth::check()) {
            return redirect()->route('eventmie.welcome');
        }
        return Eventmie::view('eventmie::auth.login');
    }

    /**
     *  after login
     */

    // check if authenticated, then redirect to welcome page
    protected function authenticated() 
    {
        
        if (\Auth::check()) {
            return redirect()->route('eventmie.welcome');
        }
    }

    public function login(Request $request) 
    {
        
        $this->validate($request, [
            
            'email'    => 'required|email',
            'password' => 'required'
            
        ]);

        $flag = \Auth::attempt ([
            'email' => $request->get ( 'email' ),
            'password' => $request->get ( 'password' ) 
        ]);
        
        if ($flag) 
        {
            $redirect = !empty(config('eventmie.route.prefix')) ? config('eventmie.route.prefix') : '/';
            return redirect($redirect);
        } 
        else 
        {
            return error_redirect( __('eventmie::em.login').' '.__('eventmie::em.failed') );
        }
    }
}

