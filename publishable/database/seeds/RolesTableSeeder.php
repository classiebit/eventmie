<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $role = Role::firstOrNew(['id' => 1]);
        if (!$role->exists) {
            $role->fill([
                'id' => 1,
                'name' => 'admin',
                'display_name' => 'Administrator',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ])->save();
        }

        $role = Role::firstOrNew(['id' => 2]);
        if (!$role->exists) {
            $role->fill([
                'id' => 2,
                'name' => 'customer',
                'display_name' => 'Customer (non-admin)',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2019-05-18 06:27:26',
            ])->save();
        }
    }
}