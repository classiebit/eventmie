<?php

use Illuminate\Database\Seeder;

use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::where('name', 'admin')->firstOrFail();

        // Dashboard
        $menuItem = MenuItem::firstOrNew(["menu_id" => $menu->id, "title" => "Dashboard", "url" => "", "route" => "voyager.dashboard", ]);
        if (!$menuItem->exists) {
            $menuItem->fill(["target" => "_self", "icon_class" => "voyager-boat", "color" => "#000000", "parent_id" => null, "order" => "1", ])->save();
        }

        // Categories
        $menuItem = MenuItem::firstOrNew(["menu_id" => $menu->id, "title" => "Categories", "url" => "", "route" => "voyager.categories.index", ]);
        if (!$menuItem->exists) {
            $menuItem->fill(["target" => "_self", "icon_class" => "voyager-categories", "color" => "", "parent_id" => null, "order" => "2", ])->save();
        }

        // Events
        $menuItem = MenuItem::firstOrNew(["menu_id" => $menu->id, "title" => "Events", "url" => "", "route" => "voyager.events.index", ]);
        if (!$menuItem->exists) {
            $menuItem->fill(["target" => "_self", "icon_class" => "voyager-calendar", "color" => "#000000", "parent_id" => null, "order" => "4", ])->save();
        }

        // Bookings
        $menuItem = MenuItem::firstOrNew(["menu_id" => $menu->id, "title" => "Bookings", "url" => "", "route" => "voyager.bookings.index", ]);
        if (!$menuItem->exists) {
            $menuItem->fill(["target" => "_self", "icon_class" => "voyager-dollar", "color" => "", "parent_id" => null, "order" => "5", ])->save();
        }

        // Users
        $menuItem = MenuItem::firstOrNew(["menu_id" => $menu->id, "title" => "Users", "url" => "", "route" => "voyager.users.index", ]);
        if (!$menuItem->exists) {
            $menuItem->fill(["target" => "_self", "icon_class" => "voyager-people", "color" => "#000000", "parent_id" => null, "order" => "8", ])->save();
        }

        // Contacts
        $menuItem = MenuItem::firstOrNew(["menu_id" => $menu->id, "title" => "Contacts", "url" => "", "route" => "voyager.contacts.index", ]);
        if (!$menuItem->exists) {
            $menuItem->fill(["target" => "_self", "icon_class" => "voyager-mail", "color" => "#000000", "parent_id" => null, "order" => "9", ])->save();
        }

        // Media
        $menuItem = MenuItem::firstOrNew(["menu_id" => $menu->id, "title" => "Media", "url" => "", "route" => "voyager.media.index", ]);
        if (!$menuItem->exists) {
            $menuItem->fill(["target" => "_self", "icon_class" => "voyager-images", "color" => "", "parent_id" => null, "order" => "10", ])->save();
        }

        // Banners
        $menuItem = MenuItem::firstOrNew(["menu_id" => $menu->id, "title" => "Banners", "url" => "", "route" => "voyager.banners.index", ]);
        if (!$menuItem->exists) {
            $menuItem->fill(["target" => "_self", "icon_class" => "voyager-photo", "color" => "#000000", "parent_id" => null, "order" => "11", ])->save();
        }

        // Pages
        $menuItem = MenuItem::firstOrNew(["menu_id" => $menu->id, "title" => "Pages", "url" => "", "route" => "voyager.pages.index", ]);
        if (!$menuItem->exists) {
            $menuItem->fill(["target" => "_self", "icon_class" => "voyager-file-text", "color" => "", "parent_id" => null, "order" => "12", ])->save();
        }

        // Settings
        $menuItem = MenuItem::firstOrNew(["menu_id" => $menu->id, "title" => "Settings", "url" => "", "route" => "voyager.settings.index", ]);
        if (!$menuItem->exists) {
            $menuItem->fill(["target" => "_self", "icon_class" => "voyager-settings", "color" => "", "parent_id" => null, "order" => "14", ])->save();
        }
    }

    protected function menuItem($field, $for)
    {
        return MenuItem::firstOrNew([$field => $for]);
    }
}