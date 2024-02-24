<?php

namespace Classiebit\Eventmie\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Classiebit\Eventmie\Notifications\ForgotPasswordNotification;
use Classiebit\Eventmie\Models\Event;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function preferredLocale()
    {
        return \App::getLocale();
    }

    // get customer when customer create booking or organiser create booking for customer
    public function get_customer($params = [])
    {
        return User::
            where([
                'id' => $params['customer_id'], 
            ])   
            ->first();   
    }

    // get user
    public function get_user($params = [])
    {
        return User::where($params)->first();   
    }


    // total customers
    public function total_customers()
    {
        return User::where(['role_id' => 2])->count();
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        // ====================== Notification ====================== 
        //forgot password notification
        try {
            $this->notify(new ForgotPasswordNotification($token));
        } catch (\Throwable $th) {}
        // ====================== Notification ====================== 
    }

    /**
     *  total user count
     */

    public function total_users()
    {
        return User::count();
    }

     /**
     *  the tags belong to organiser means users
     */

    public function events()
    {
        return $this->hasMany(Event::class);
    }
    
}
