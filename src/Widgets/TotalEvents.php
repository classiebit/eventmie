<?php

namespace Classiebit\Eventmie\Widgets;

use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use Facades\Classiebit\Eventmie\Eventmie;
use TCG\Voyager\Widgets\BaseDimmer;


class TotalEvents extends BaseDimmer
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
        
        $count  = \Classiebit\Eventmie\Models\Event::count();
        // $count  = Voyager::model('Page')->count();
        $string = trans_choice('Events', $count);

        return Eventmie::view('eventmie::widgets.total_events', array_merge($this->config, [
            'icon'   => 'voyager-shop',
            'title'  => "{$count} {$string}",
            'text'   => __('Total Events', ['count' => $count, 'string' => Str::lower($string)]),
            'button' => [
                'text' => __('view all events'),
                'link' => route('voyager.events.index'),
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
