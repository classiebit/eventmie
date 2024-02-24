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
        $menu = $this->menus('name', 'admin');
        if (!$menu->exists) {
            $menu->save();
        }        
    }

    protected function menus($field, $for)
    {
        return Menu::firstOrNew([$field => $for]);
    }
}