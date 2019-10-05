<?php

namespace Classiebit\Eventmie\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Classiebit\Eventmie\Notifications\ForgotPasswordNotification;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // get customer info
    public function get_customer($params = [])
    {
        return User::
            where([
                'id' => $params['customer_id'], 
            ])   
            ->first();   
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
                
        // \Notification::send(new ForgotPasswordNotification($token));
        $this->notify(new ForgotPasswordNotification($token));

        // ====================== Notification ====================== 
    }
}
