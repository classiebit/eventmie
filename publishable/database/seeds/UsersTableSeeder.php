<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$J1T77qtNDSXQU5rtnRLBOO/uwjPTwbIv4/b3zEFX3MzxKdeCyAQwu',
                'remember_token' => 'TxgKCblCFlTzNss8kBg2DKLzwsyVbzNzF0Z3y7uKUoh2W2A6RXHxgzQBvPh3',
                'settings' => '{"locale":"en"}',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2019-09-11 04:28:24',
            ),
            1 => 
            array (
                'id' => 2,
                'role_id' => 2,
                'name' => 'David lane',
                'email' => 'davidlane@mail.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$PLAI6IHF2I2ygCcRWjGZq.RjZcIaP.ZwFxXC4XT9WtX82tKdvkMxi',
                'remember_token' => 'ybKlI7Iv7YzJ9sy8beQyWUirLpjOFGCqvx7CszXal78WmRXHwU073BIf8jTZ',
                'settings' => '{"locale":"en"}',
                'created_at' => '2019-09-02 07:26:33',
                'updated_at' => '2019-10-04 09:00:49',
            ),
        ));
        
        
    }
}