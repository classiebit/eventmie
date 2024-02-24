<?php

use Illuminate\Database\Seeder;
use Classiebit\Eventmie\Models\User;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        if (!User::count()) {

            $users = array(
                array(
                    'id' => 1,
                    'role_id' => 1,
                    'name' => 'Admin',
                    'email' => 'admin@admin.com',
                    'avatar' => 'users/November2023/X14Sai1THGW3NnsEhs9h.jpg',
                    'email_verified_at' => '2019-09-02 07:37:28',
                    'password' => bcrypt('password'),
                    'remember_token' => 'DUl5G6kvskWDIvfr8wCL2fFpPp3YIrUm806iAo7yKwlRIE9nfBoOvlBGDMqZ',
                    'settings' => '{"locale":"en"}',
                    'created_at' => '2018-12-21 10:25:08',
                    'updated_at' => '2019-09-11 04:28:24',
                ),
                array(
                    'id' => 3,
                    'role_id' => 2,
                    'name' => 'David Lane',
                    'email' => 'davidlane@mail.com',
                    'avatar' => 'users/default.png',
                    'email_verified_at' => '2019-09-02 07:37:28',
                    'password' => bcrypt('password'),
                    'remember_token' => 'hzbfL7ZVwwSt6Rbqd62VZe45SP5tjq8I1yPGF74TTsH1xcxErbVdv02v0Bbl',
                    'settings' => '{"locale":"en"}',
                    'created_at' => '2019-09-02 07:26:33',
                    'updated_at' => '2019-09-14 08:32:31',
                )
            );

            User::insert($users);
            
        } else {

            // if user exist then make first user admin
            $user = User::firstOrNew(['id' => 1]);
            if ($user->exists) {
                $user->fill([
                    'role_id'        => 1,
                ])->save();
            }
        }
        
    }
}