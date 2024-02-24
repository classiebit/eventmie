<?php

use Illuminate\Database\Seeder;
use Classiebit\Eventmie\Models\Event;

class EventsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $event = Event::count();
        if($event) 
            return true;

        $event = $this->event('id', 1);
        if (!$event->exists) {
            $event->fill([
                'title' => 'Digital Marketing Seminar',
                'description' => 'Resolution diminution conviction so mr at unpleasing simplicity',
                'thumbnail' => 'events/November2023/1701172867248.webp',
                'poster' => 'events/November2023/1701172867AxxY4MHTU5.webp',
                'images' => '["events\\/November2023\\/1701172867248.webp","events\\/November2023\\/1701172867248.webp","events\\/November2023\\/1701172867248.webp","events\\/November2023\\/1701172867248.webp","events\\/November2023\\/1701172867248.webp","events\\/November2023\\/1701172867248.webp"]',
                'venue' => 'History Museum',
                'address' => 'Feet evil, occasional boisterous',
                'city' => 'Nagano',
                'state' => 'Chūbu',
                'zipcode' => '111-1212',
                'country_id' => 110,
                'start_date' => '2025-11-29',
                'end_date' => '2025-11-29',
                'start_time' => '08:00:00',
                'end_time' => '10:30:00',
                'status' => 1,
                'meta_title' => NULL,
                'meta_keywords' => NULL,
                'meta_description' => NULL,
                'category_id' => 1,
                'created_at' => '2024-01-01 12:52:59',
                'updated_at' => '2024-01-11 09:07:57',
                'slug' => 'digital-marketing-seminar',
                'publish' => 1,
                'is_publishable' => '{"detail":1,"location":1,"timing":1,"publish":1,"media":1}',
            ])->save();
        }
        
    }

    protected function event($field, $for)
    {
        return Event::firstOrNew([$field => $for]);
    }
}