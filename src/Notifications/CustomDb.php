<?php

namespace Classiebit\Eventmie\Notifications;

use Illuminate\Notifications\Notification;

class CustomDb
{

    public function send($notifiable, Notification $notification)
    {
        $data = $notification->toDatabase($notifiable);
        
        if($data['n_type'] != 'contact')
        {
            return $notifiable->routeNotificationFor('database')->create([
                'id'            => $notification->id,
                'n_type'        => $data['n_type'], //<-- comes from toDatabase() Method below
                'type'          => get_class($notification),
                'data'          => $data,
                'read_at'       => null,
            ]);
        }
        else
        {
            // only for conatact page
            $data1 = [
                'id'                => $notification->id,
                'notifiable_id'     => 1,
                'n_type'            => $data['n_type'], //<-- comes from toDatabase() Method below
                'type'              => get_class($notification),
                'data'              => json_encode($data),
                'read_at'           => null,
                'notifiable_type'   => 'Classiebit\Eventmie\Models\User',
                'created_at'        => \Carbon\Carbon::now(),
                'updated_at'        => \Carbon\Carbon::now(),
            ];

            \DB::table('notifications')->insert($data1);
        }    
    }

}