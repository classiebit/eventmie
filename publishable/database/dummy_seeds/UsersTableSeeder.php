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
            2 => 
            array (
                'id' => 3,
                'role_id' => 2,
                'name' => 'Cora Woods',
                'email' => 'corawoods@mail.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$SvqAUTXJksvKlobVjQsnaOXMcbk9PB3Hl2Nok1VpJ0E9TW8B/uSm.',
                'remember_token' => 'PKnLIlkjHmocMgfJD6Tf6qjm0HrtZkaGSbxdqCZrd39W5wIH1dclGAyeW0WB',
                'settings' => '{"locale":"en"}',
                'created_at' => '2019-09-02 07:27:01',
                'updated_at' => '2019-09-02 07:27:01',
            ),
            3 => 
            array (
                'id' => 4,
                'role_id' => 2,
                'name' => 'Roman Pane',
                'email' => 'romanpane@mail.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$VeIhyXK8D16Ixuj9DUs3pOl.lHdlT.cB7kP1m0nPLdJmPzzTwkVq2',
                'remember_token' => 'v9nkCVP28bTNgxsEJi6bujO7DpEqy42dmL6qYefXHvP0fhR9fsJwEJrZTPM9',
                'settings' => '{"locale":"en"}',
                'created_at' => '2019-09-02 07:29:36',
                'updated_at' => '2019-09-02 07:29:36',
            ),
            4 => 
            array (
                'id' => 5,
                'role_id' => 2,
                'name' => 'Tara Young',
                'email' => 'tarayoung@mail.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$KEnxywtTI2uqEs7oM9NOb.fnaW.SbFDVmGMmW8rZWepugFn0L9UkS',
                'remember_token' => '9TQXvXe6ibM2x99jPxYItsWx7wCG4FzOsfLZc15nY6rO8t41NPripAWw3TwH',
                'settings' => '{"locale":"en"}',
                'created_at' => '2019-09-02 07:36:37',
                'updated_at' => '2019-09-02 07:36:37',
            ),
        ));
        
        
    }
}