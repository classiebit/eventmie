<?php

namespace Classiebit\Eventmie\Widgets;

use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use Facades\Classiebit\Eventmie\Eventmie;
use TCG\Voyager\Widgets\BaseDimmer;
use Classiebit\Eventmie\Models\User;
use DB;
class Notifications extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
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
                            ->get()
                            ->toArray();
        
        $count  = $user->unreadNotifications->count();
        
        $string = trans_choice('Notifications', $count);

        return Eventmie::view('eventmie::widgets.notifications', array_merge($this->config, [
            'icon'   => 'voyager-bell',
            'title'  => "{$count} {$string}",
            'text'   => __('All Notification', ['count' => $count, 'string' => Str::lower($string)]),
            'button' => [
                'text' => __('view all bookings'),
                'link' => route('eventmie.events_index'),
            ],
            'user'  => $user,
            'notifications' => $notifications,
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return true;
    }
}
