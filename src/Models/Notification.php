<?php

namespace Classiebit\Eventmie\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

use Classiebit\Eventmie\Models\User;
use Auth;

class Notification extends Model
{


    /**
     *  total notification only for admin
     */
    public function total_notifications()
    {
        $user_id        = \Auth::id();
        
        $user           = User::find($user_id);
        $mode           = config('database.connections.mysql.strict');

        $this->table    = 'notifications'; 
        $query          = DB::table($this->table);

        if(!$mode)
        {
            // safe mode is off
            $select = array(
                            
                            "$this->table.id",
                            DB::raw("COUNT($this->table.n_type) as total"),
                            "$this->table.n_type",
                            "$this->table.data",
                            "$this->table.read_at",
                            "$this->table.updated_at",
                        );
        }
        else
        {
            // safe mode is on
            $select = array(
                            DB::raw("ANY_VALUE($this->table.id) as id"),
                            DB::raw("COUNT($this->table.n_type) as total"),
                            "$this->table.n_type",
                            DB::raw("ANY_VALUE($this->table.data) as data"),
                            DB::raw("ANY_VALUE($this->table.read_at) as read_at"),
                            DB::raw("ANY_VALUE($this->table.updated_at) as updated_at"),
                        );
        }
        
        $notifications  =   $query->select($select)
                            ->where("$this->table.notifiable_id", $user_id)
                            ->where(["$this->table.read_at" =>  null])
                            ->where("$this->table.n_type", '!=',  null)
                            ->groupBy("$this->table.n_type")
                            ->get();
                            
        $notifications  = to_array($notifications);
        
        return $notifications;
    }
}    