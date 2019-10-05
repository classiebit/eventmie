<?php

namespace Classiebit\Eventmie\Widgets;

use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use Facades\Classiebit\Eventmie\Eventmie;
use TCG\Voyager\Widgets\BaseDimmer;

class TotalBookings extends BaseDimmer
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
        $count  = \Classiebit\Eventmie\Models\Booking::count();
        // $count  = Voyager::model('Page')->count();
        $string = trans_choice('Bookings', $count);

        return Eventmie::view('eventmie::widgets.total_bookings', array_merge($this->config, [
            'icon'   => 'voyager-bag',
            'title'  => "{$count} {$string}",
            'text'   => __('Total Bookings', ['count' => $count, 'string' => Str::lower($string)]),
            'button' => [
                'text' => __('view all bookings'),
                'link' => route('eventmie.events_index'),
            ],
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
