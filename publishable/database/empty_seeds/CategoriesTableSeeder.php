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
        ));
        
        
    }
}