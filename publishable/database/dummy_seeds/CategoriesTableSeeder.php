<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Business & Seminars',
                'slug' => 'business-&-seminars',
                'created_at' => '2019-09-02 06:26:33',
                'updated_at' => '2019-10-05 06:01:50',
                'status' => 1,
                'thumb' => 'categories/October2019/oJbtSjHLoCcSEPva4IJe.jpg',
                'image' => NULL,
                'template' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Sports & Fitness',
                'slug' => 'sports-&-fitness',
                'created_at' => '2019-09-02 07:05:47',
                'updated_at' => '2019-10-05 06:02:00',
                'status' => 1,
                'thumb' => 'categories/October2019/3YpGsqN75rDAjntQewmP.jpg',
                'image' => NULL,
                'template' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Music & Concerts',
                'slug' => 'music-&-concerts',
                'created_at' => '2019-09-02 07:07:56',
                'updated_at' => '2019-10-05 06:02:10',
                'status' => 1,
                'thumb' => 'categories/October2019/1axS9qJxNWiuzqVmqPDr.jpg',
                'image' => NULL,
                'template' => 1,
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'Food & Drink',
                'slug' => 'food-&-drink',
                'created_at' => '2019-09-02 07:10:10',
                'updated_at' => '2019-10-05 06:02:18',
                'status' => 1,
                'thumb' => 'categories/October2019/rMbuGTrvUFEC13tykKcq.jpg',
                'image' => NULL,
                'template' => 1,
            ),
        ));
        
        
    }
}