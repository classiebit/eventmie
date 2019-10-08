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
        $this->seed('BannersTableSeeder');
        $this->seed('CategoriesTableSeeder');
        $this->seed('CountriesTableSeeder');
        $this->seed('DataTypesTableSeeder');
        $this->seed('DataRowsTableSeeder');
        $this->seed('EventsTableSeeder');
        $this->seed('PagesTableSeeder');
        $this->seed('SettingsTableSeeder');
        $this->seed('MenusTableSeeder');
        $this->seed('MenuItemsTableSeeder');
        $this->seed('TranslationsTableSeeder');
        $this->seed('PermissionsTableSeeder');
        $this->seed('RolesTableSeeder');
        $this->seed('PermissionRoleTableSeeder');
        $this->seed('UsersTableSeeder');
    }
}
