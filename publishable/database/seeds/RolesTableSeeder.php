<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'display_name' => 'Administrator',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'customer',
            'display_name' => 'Customer (non-admin)',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2019-05-18 06:27:26',
            ),
        ));
        
        
    }
}