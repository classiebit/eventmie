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
        $role = $this->role('id', 1);
        if (!$role->exists) 
        {
            $role->fill([
                'name' => 'admin',
                'display_name' => 'Administrator',
            ])->save();
        }
        
        $role = $this->role('id', 2);
        if (!$role->exists) 
        {
            $role->fill([
                'name' => 'customer',
                'display_name' => 'Customer (non-admin)',
            ])->save();
        }
        
    }

    protected function role($field, $for)
    {
        return Role::firstOrNew([$field => $for]);
    }
}