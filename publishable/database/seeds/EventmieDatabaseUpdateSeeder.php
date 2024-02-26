<?php

use Illuminate\Database\Seeder;
use Classiebit\Eventmie\Traits\Seedable;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class EventmieDatabaseUpdateSeeder extends Seeder
{
    use Seedable;

    protected $seedersPath = __DIR__.'/';

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* ===== ORDER IS IMPORTANT ===== */
        /* ===== KEEP THE ORDER SAME ===== */
        // update voyager tables
        $this->seed('DataTypesTableSeeder');
        $this->seed('DataRowsTableSeeder');
        $this->seed('MenusTableSeeder');
        $this->seed('MenuItemsTableSeeder');
        $this->seed('PermissionsTableSeeder');
        $this->seed('PermissionRoleTableSeeder');
        $this->seed('SettingsTableSeeder');
    }
}
