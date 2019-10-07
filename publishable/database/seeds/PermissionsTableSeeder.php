<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'browse_admin',
                'table_name' => NULL,
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'browse_bread',
                'table_name' => NULL,
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'browse_database',
                'table_name' => NULL,
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'browse_media',
                'table_name' => NULL,
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'browse_compass',
                'table_name' => NULL,
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'browse_menus',
                'table_name' => 'menus',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'read_menus',
                'table_name' => 'menus',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'edit_menus',
                'table_name' => 'menus',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'add_menus',
                'table_name' => 'menus',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'delete_menus',
                'table_name' => 'menus',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            10 => 
            array (
                'id' => 11,
                'key' => 'browse_roles',
                'table_name' => 'roles',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            11 => 
            array (
                'id' => 12,
                'key' => 'read_roles',
                'table_name' => 'roles',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            12 => 
            array (
                'id' => 13,
                'key' => 'edit_roles',
                'table_name' => 'roles',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            13 => 
            array (
                'id' => 14,
                'key' => 'add_roles',
                'table_name' => 'roles',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            14 => 
            array (
                'id' => 15,
                'key' => 'delete_roles',
                'table_name' => 'roles',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            15 => 
            array (
                'id' => 16,
                'key' => 'browse_users',
                'table_name' => 'users',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            16 => 
            array (
                'id' => 17,
                'key' => 'read_users',
                'table_name' => 'users',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            17 => 
            array (
                'id' => 18,
                'key' => 'edit_users',
                'table_name' => 'users',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            18 => 
            array (
                'id' => 19,
                'key' => 'add_users',
                'table_name' => 'users',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            19 => 
            array (
                'id' => 20,
                'key' => 'delete_users',
                'table_name' => 'users',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            20 => 
            array (
                'id' => 21,
                'key' => 'browse_settings',
                'table_name' => 'settings',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            21 => 
            array (
                'id' => 22,
                'key' => 'read_settings',
                'table_name' => 'settings',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            22 => 
            array (
                'id' => 23,
                'key' => 'edit_settings',
                'table_name' => 'settings',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            23 => 
            array (
                'id' => 24,
                'key' => 'add_settings',
                'table_name' => 'settings',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            24 => 
            array (
                'id' => 25,
                'key' => 'delete_settings',
                'table_name' => 'settings',
                'created_at' => '2018-12-21 10:25:07',
                'updated_at' => '2018-12-21 10:25:07',
            ),
            25 => 
            array (
                'id' => 36,
                'key' => 'browse_pages',
                'table_name' => 'pages',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            26 => 
            array (
                'id' => 37,
                'key' => 'read_pages',
                'table_name' => 'pages',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            27 => 
            array (
                'id' => 38,
                'key' => 'edit_pages',
                'table_name' => 'pages',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            28 => 
            array (
                'id' => 39,
                'key' => 'add_pages',
                'table_name' => 'pages',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            29 => 
            array (
                'id' => 40,
                'key' => 'delete_pages',
                'table_name' => 'pages',
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            30 => 
            array (
                'id' => 41,
                'key' => 'browse_hooks',
                'table_name' => NULL,
                'created_at' => '2018-12-21 10:25:08',
                'updated_at' => '2018-12-21 10:25:08',
            ),
            31 => 
            array (
                'id' => 42,
                'key' => 'browse_events',
                'table_name' => 'events',
                'created_at' => '2018-12-22 08:54:46',
                'updated_at' => '2018-12-22 08:54:46',
            ),
            32 => 
            array (
                'id' => 43,
                'key' => 'read_events',
                'table_name' => 'events',
                'created_at' => '2018-12-22 08:54:46',
                'updated_at' => '2018-12-22 08:54:46',
            ),
            33 => 
            array (
                'id' => 44,
                'key' => 'edit_events',
                'table_name' => 'events',
                'created_at' => '2018-12-22 08:54:46',
                'updated_at' => '2018-12-22 08:54:46',
            ),
            34 => 
            array (
                'id' => 45,
                'key' => 'add_events',
                'table_name' => 'events',
                'created_at' => '2018-12-22 08:54:46',
                'updated_at' => '2018-12-22 08:54:46',
            ),
            35 => 
            array (
                'id' => 46,
                'key' => 'delete_events',
                'table_name' => 'events',
                'created_at' => '2018-12-22 08:54:46',
                'updated_at' => '2018-12-22 08:54:46',
            ),
            36 => 
            array (
                'id' => 72,
                'key' => 'browse_categories',
                'table_name' => 'categories',
                'created_at' => '2018-12-24 09:09:20',
                'updated_at' => '2018-12-24 09:09:20',
            ),
            37 => 
            array (
                'id' => 73,
                'key' => 'read_categories',
                'table_name' => 'categories',
                'created_at' => '2018-12-24 09:09:20',
                'updated_at' => '2018-12-24 09:09:20',
            ),
            38 => 
            array (
                'id' => 74,
                'key' => 'edit_categories',
                'table_name' => 'categories',
                'created_at' => '2018-12-24 09:09:20',
                'updated_at' => '2018-12-24 09:09:20',
            ),
            39 => 
            array (
                'id' => 75,
                'key' => 'add_categories',
                'table_name' => 'categories',
                'created_at' => '2018-12-24 09:09:20',
                'updated_at' => '2018-12-24 09:09:20',
            ),
            40 => 
            array (
                'id' => 76,
                'key' => 'delete_categories',
                'table_name' => 'categories',
                'created_at' => '2018-12-24 09:09:20',
                'updated_at' => '2018-12-24 09:09:20',
            ),
            41 => 
            array (
                'id' => 102,
                'key' => 'browse_contacts',
                'table_name' => 'contacts',
                'created_at' => '2019-07-09 08:52:22',
                'updated_at' => '2019-07-09 08:52:22',
            ),
            42 => 
            array (
                'id' => 103,
                'key' => 'read_contacts',
                'table_name' => 'contacts',
                'created_at' => '2019-07-09 08:52:22',
                'updated_at' => '2019-07-09 08:52:22',
            ),
            43 => 
            array (
                'id' => 104,
                'key' => 'edit_contacts',
                'table_name' => 'contacts',
                'created_at' => '2019-07-09 08:52:22',
                'updated_at' => '2019-07-09 08:52:22',
            ),
            44 => 
            array (
                'id' => 105,
                'key' => 'add_contacts',
                'table_name' => 'contacts',
                'created_at' => '2019-07-09 08:52:22',
                'updated_at' => '2019-07-09 08:52:22',
            ),
            45 => 
            array (
                'id' => 106,
                'key' => 'delete_contacts',
                'table_name' => 'contacts',
                'created_at' => '2019-07-09 08:52:22',
                'updated_at' => '2019-07-09 08:52:22',
            ),
            46 => 
            array (
                'id' => 112,
                'key' => 'browse_bookings',
                'table_name' => 'bookings',
                'created_at' => '2019-08-17 05:29:55',
                'updated_at' => '2019-08-17 05:29:55',
            ),
            47 => 
            array (
                'id' => 113,
                'key' => 'read_bookings',
                'table_name' => 'bookings',
                'created_at' => '2019-08-17 05:29:55',
                'updated_at' => '2019-08-17 05:29:55',
            ),
            48 => 
            array (
                'id' => 114,
                'key' => 'edit_bookings',
                'table_name' => 'bookings',
                'created_at' => '2019-08-17 05:29:55',
                'updated_at' => '2019-08-17 05:29:55',
            ),
            49 => 
            array (
                'id' => 115,
                'key' => 'add_bookings',
                'table_name' => 'bookings',
                'created_at' => '2019-08-17 05:29:55',
                'updated_at' => '2019-08-17 05:29:55',
            ),
            50 => 
            array (
                'id' => 116,
                'key' => 'delete_bookings',
                'table_name' => 'bookings',
                'created_at' => '2019-08-17 05:29:55',
                'updated_at' => '2019-08-17 05:29:55',
            ),
            51 => 
            array (
                'id' => 132,
                'key' => 'browse_banners',
                'table_name' => 'banners',
                'created_at' => '2019-10-04 12:34:41',
                'updated_at' => '2019-10-04 12:34:41',
            ),
            52 => 
            array (
                'id' => 133,
                'key' => 'read_banners',
                'table_name' => 'banners',
                'created_at' => '2019-10-04 12:34:41',
                'updated_at' => '2019-10-04 12:34:41',
            ),
            53 => 
            array (
                'id' => 134,
                'key' => 'edit_banners',
                'table_name' => 'banners',
                'created_at' => '2019-10-04 12:34:41',
                'updated_at' => '2019-10-04 12:34:41',
            ),
            54 => 
            array (
                'id' => 135,
                'key' => 'add_banners',
                'table_name' => 'banners',
                'created_at' => '2019-10-04 12:34:41',
                'updated_at' => '2019-10-04 12:34:41',
            ),
            55 => 
            array (
                'id' => 136,
                'key' => 'delete_banners',
                'table_name' => 'banners',
                'created_at' => '2019-10-04 12:34:41',
                'updated_at' => '2019-10-04 12:34:41',
            ),
        ));
        
        
    }
}