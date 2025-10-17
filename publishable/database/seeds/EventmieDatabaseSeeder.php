<?php

use Illuminate\Database\Seeder;
use Classiebit\Eventmie\Traits\Seedable;

class EventmieDatabaseSeeder extends Seeder
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
        /* ========== ORDER IS IMPORTANT ========== */
        /* ========== KEEP THE ORDER SAME ========== */
        
        // eventmie tables
        $this->seed('BannersTableSeeder');
        $this->seed('CategoriesTableSeeder');
        $this->seed('CountriesTableSeeder');
        $this->seed('EventsTableSeeder');
        $this->seed('PagesTableSeeder');
        
        // voyager tables
        $this->seed('RolesTableSeeder');
        $this->seed('UsersTableSeeder');
        $this->seed('DataTypesTableSeeder');
        $this->seed('DataRowsTableSeeder');
        $this->seed('MenusTableSeeder');
        $this->seed('MenuItemsTableSeeder');
        $this->seed('PermissionsTableSeeder');
        $this->seed('PermissionRoleTableSeeder');
        $this->seed('TranslationsTableSeeder');
        $this->seed('SettingsTableSeeder');
    }
}
