<?php

namespace Classiebit\Eventmie\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Classiebit\Eventmie\Models\User;
use Facades\Classiebit\Eventmie\Eventmie;

use Classiebit\Eventmie\Notifications\MailNotification;

use Intervention\Image\Facades\Image;
use File;
Use Illuminate\Support\Carbon;

class ProfileController extends Controller
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        // language change
        $this->middleware('common');
    
        $this->middleware('auth');
    }
    
    /**
     * index
     *
     * @param  String $view
     * @param  Array $extra
     * @return view
     */
    public function index($view = 'eventmie::profile.profile', $extra = [])
    {
        $user  = $this->getAuthUser();

        return Eventmie::view($view, compact('user', 'extra'));
    }
    
        
    /**
     * getAuthUser
     *
     * @return \App\Model\User $user
     */
    public function getAuthUser ()
    {
        return Auth::user();
    }

        
    /**
     * updateAuthUser
     *
     * @param   Illuminate\Http\Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function updateAuthUser (Request $request)
    {
        // demo mode restrictions
        if(config('voyager.demo_mode'))
        {
            return error_redirect('Demo mode');
        }
        
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.Auth::id()
        ]);
        
        $user = User::find(Auth::id());

        $user->name                  = $request->name;
        $user->email                 = $request->email;
        
        $this->uploadImage($request, $user);

        $user->save();

        // redirect no matter what so that it never turns back
        $msg = __('eventmie::em.saved').' '.__('eventmie::em.successfully');
        return success_redirect($msg, route('eventmie.profile'));
        
    }

        
    /**
     * updateSecurity
     *
     * @param   Illuminate\Http\Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function updateSecurity (Request $request)
    {   
        // demo mode restrictions
        if(config('voyager.demo_mode'))
        {
            return error_redirect('Demo mode');
        }

        if(!empty($request->current))
        {
            $data = $this->updateAuthUserPassword($request);
            if($data['status'] == false)
            {
                return error_redirect($data['errors']);
            }
        }

         // redirect no matter what so that it never turns back
        $msg = __('eventmie::em.saved').' '.__('eventmie::em.successfully');
        return success_redirect($msg, route('eventmie.profile').'#/userSecurity');
    }

    
    /**
     * updateAuthUserPassword
     *
     * @param  Illuminate\Http\Request $request
     * @return boolean
     */
    public function updateAuthUserPassword(Request $request) 
    {
        // demo mode restrictions
        if(config('voyager.demo_mode'))
        {
            return error_redirect('Demo mode');
        }
        $this->validate($request, [
            'current' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = User::find(Auth::id());

        if (!Hash::check($request->current, $user->password)) {
            return ['errors' => __('eventmie::em.current_password_not_match') , 'status' => false];
        }

        
        $user->password = Hash::make($request->password);
        $user->save();

        return ['status' => true];
    }

        
    /**
     * uploadImage
     *
     * @param   Illuminate\Http\Request $request
     * @param  App\Model\User $user
     * @return void
     */
    protected function uploadImage(Request $request, User $user)
    {
        $path   = 'users/';

        // for image
        if($request->hasfile('avatar')) 
        { 
            $request->validate([
                'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            
            ]); 
        
            $file = $request->file('avatar');
    
            $extension       = $file->getClientOriginalExtension(); // getting image extension
            $avatar          = time().rand(1,988).'.'.'webp';

            $image_resize    = Image::make($file)->encode('webp', 90)->resize(512, 512, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            
            // if directory not exist then create directiory
            if (! File::exists(storage_path('/app/public/').$path)) {
                File::makeDirectory(storage_path('/app/public/').$path, 0775, true);
            }
            
            $image_resize->save(storage_path('/app/public/'.$path.$avatar));
            
            $user->avatar    = $path.$avatar;
            
        }
        
        if(empty($user->avatar) || $user->avatar == 'users/default.png')
        {
            $request->validate([
                'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            
            ]); 
        }
        

    }
 
}
