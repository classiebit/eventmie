<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
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
        if (User::count() == 0) {
            User::create([
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(60),
                'role_id'        => 1,
                'settings' => '{"locale":"en"}',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2019-09-11 04:28:24',
            ]);
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