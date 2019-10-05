<?php

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('banners')->delete();
        
        \DB::table('banners')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Event Planning Platform Reimagined',
                'subtitle' => 'Laravel 2020',
                'image' => 'banners/August2019/3MIAC8BaLwk8ytlYYvVi.jpg',
                'status' => 1,
                'created_at' => '2019-08-31 09:50:13',
                'updated_at' => '2019-10-05 05:32:44',
            ),
        ));
        
        
    }
}