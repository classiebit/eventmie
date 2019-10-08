<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $menu = $this->menu('id', 1);
        if (!$menu->exists) {
            \DB::table('menus')->insert(array (
                0 => 
                array (
                    'id' => 1,
                    'name' => 'admin',
                    'created_at' => '2018-12-21 10:25:07',
                    'updated_at' => '2018-12-21 10:25:07',
                ),
            ));
        }
    }

    protected function menu($field, $for)
    {
        return Menu::firstOrNew([$field => $for]);
    }
}
