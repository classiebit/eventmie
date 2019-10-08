<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;

class DataTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $dataType = $this->dataType('id', 1);
        if (!$dataType->exists) 
        {

                \DB::table('data_types')->insert(
                array (
                    'id' => 1,
                    'name' => 'users',
                    'slug' => 'users',
                    'display_name_singular' => 'User',
                    'display_name_plural' => 'Users',
                    'icon' => 'voyager-person',
                    'model_name' => 'Classiebit\\Eventmie\\Models\\User',
                    'policy_name' => 'TCG\\Voyager\\Policies\\UserPolicy',
                    'controller' => '\\Classiebit\\Eventmie\\Http\\Controllers\\Voyager\\VoyagerUserController',
                    'description' => NULL,
                    'generate_permissions' => 1,
                    'server_side' => 1,
                    'details' => '{"order_column":"id","order_display_column":"id","order_direction":"desc","default_search_key":"email","scope":null}',
                    'created_at' => '2018-12-21 10:25:07',
                    'updated_at' => '2019-10-05 05:27:38',
                ));
                \DB::table('data_types')->insert(
                array (
                    'id' => 2,
                    'name' => 'menus',
                    'slug' => 'menus',
                    'display_name_singular' => 'Menu',
                    'display_name_plural' => 'Menus',
                    'icon' => 'voyager-list',
                    'model_name' => 'TCG\\Voyager\\Models\\Menu',
                    'policy_name' => NULL,
                    'controller' => NULL,
                    'description' => NULL,
                    'generate_permissions' => 1,
                    'server_side' => 0,
                    'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}',
                    'created_at' => '2018-12-21 10:25:07',
                    'updated_at' => '2019-10-05 05:27:27',
                ));
                \DB::table('data_types')->insert(
                array (
                    'id' => 3,
                    'name' => 'roles',
                    'slug' => 'roles',
                    'display_name_singular' => 'Role',
                    'display_name_plural' => 'Roles',
                    'icon' => 'voyager-lock',
                    'model_name' => 'TCG\\Voyager\\Models\\Role',
                    'policy_name' => NULL,
                    'controller' => NULL,
                    'description' => NULL,
                    'generate_permissions' => 1,
                    'server_side' => 0,
                    'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}',
                    'created_at' => '2018-12-21 10:25:07',
                    'updated_at' => '2019-10-05 05:27:33',
                ));
                \DB::table('data_types')->insert(
                array (
                    'id' => 6,
                    'name' => 'pages',
                    'slug' => 'pages',
                    'display_name_singular' => 'Page',
                    'display_name_plural' => 'Pages',
                    'icon' => 'voyager-file-text',
                    'model_name' => 'Classiebit\\Eventmie\\Models\\Page',
                    'policy_name' => NULL,
                    'controller' => NULL,
                    'description' => NULL,
                    'generate_permissions' => 1,
                    'server_side' => 1,
                    'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}',
                    'created_at' => '2018-12-21 10:25:08',
                    'updated_at' => '2019-10-05 05:27:31',
                ));
                \DB::table('data_types')->insert(
                array (
                    'id' => 7,
                    'name' => 'events',
                    'slug' => 'events',
                    'display_name_singular' => 'Event',
                    'display_name_plural' => 'Events',
                    'icon' => 'voyager-calendar',
                    'model_name' => 'Classiebit\\Eventmie\\Models\\Event',
                    'policy_name' => NULL,
                    'controller' => '\\Classiebit\\Eventmie\\Http\\Controllers\\Voyager\\EventsController',
                    'description' => NULL,
                    'generate_permissions' => 1,
                    'server_side' => 1,
                    'details' => '{"order_column":"id","order_display_column":"id","order_direction":"desc","default_search_key":"title","scope":null}',
                    'created_at' => '2018-12-22 08:54:46',
                    'updated_at' => '2019-10-05 05:27:24',
                ));
                \DB::table('data_types')->insert(
                array (
                    'id' => 15,
                    'name' => 'categories',
                    'slug' => 'categories',
                    'display_name_singular' => 'Category',
                    'display_name_plural' => 'Categories',
                    'icon' => 'voyager-categories',
                    'model_name' => 'Classiebit\\Eventmie\\Models\\Category',
                    'policy_name' => NULL,
                    'controller' => NULL,
                    'description' => NULL,
                    'generate_permissions' => 1,
                    'server_side' => 1,
                    'details' => '{"order_column":"id","order_display_column":"id","order_direction":"asc","default_search_key":"name","scope":null}',
                    'created_at' => '2018-12-24 09:09:20',
                    'updated_at' => '2019-10-05 05:27:16',
                ));
                \DB::table('data_types')->insert(
                array (
                    'id' => 25,
                    'name' => 'contacts',
                    'slug' => 'contacts',
                    'display_name_singular' => 'Contact',
                    'display_name_plural' => 'Contacts',
                    'icon' => 'voyager-mail',
                    'model_name' => 'Classiebit\\Eventmie\\Models\\Contact',
                    'policy_name' => NULL,
                    'controller' => '\\Classiebit\\Eventmie\\Http\\Controllers\\Voyager\\ContactsController',
                    'description' => NULL,
                    'generate_permissions' => 1,
                    'server_side' => 1,
                    'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                    'created_at' => '2019-07-09 08:52:22',
                    'updated_at' => '2019-10-05 05:27:19',
                ));
                \DB::table('data_types')->insert(
                array (
                    'id' => 27,
                    'name' => 'bookings',
                    'slug' => 'bookings',
                    'display_name_singular' => 'Booking',
                    'display_name_plural' => 'Bookings',
                    'icon' => 'voyager-dollar',
                    'model_name' => 'Classiebit\\Eventmie\\Models\\Booking',
                    'policy_name' => NULL,
                    'controller' => '\\Classiebit\\Eventmie\\Http\\Controllers\\Voyager\\BookingsController',
                    'description' => NULL,
                    'generate_permissions' => 1,
                    'server_side' => 1,
                    'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                    'created_at' => '2019-08-17 05:29:55',
                    'updated_at' => '2019-10-05 05:27:14',
                ));
                \DB::table('data_types')->insert(
                array (
                    'id' => 31,
                    'name' => 'banners',
                    'slug' => 'banners',
                    'display_name_singular' => 'Banner',
                    'display_name_plural' => 'Banners',
                    'icon' => 'voyager-photo',
                    'model_name' => 'Classiebit\\Eventmie\\Models\\Banner',
                    'policy_name' => NULL,
                    'controller' => NULL,
                    'description' => NULL,
                    'generate_permissions' => 1,
                    'server_side' => 0,
                    'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                    'created_at' => '2019-10-04 12:34:41',
                    'updated_at' => '2019-10-05 05:32:39',
                ));
            
        }
        
        
    }

    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}