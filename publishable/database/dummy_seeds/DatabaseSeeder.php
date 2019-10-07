<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BannersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BookingsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(DataTypesTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(MenuItemsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(TranslationsTableSeeder::class);
        $this->call(DataRowsTableSeeder::class);
    }
}
