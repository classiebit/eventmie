<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Page;


class PagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $page = Page::count();
        if($page) 
            return true;

        $page = $this->page('id', 1);
        if (!$page->exists) {
            $page->fill([
                'author_id' => 1,
                'title' => 'About Us',
                'excerpt' => 'about',
                'body' => 'Change about us content',
                'image' => NULL,
                'slug' => 'about',
                'meta_description' => 'About us description',
                'meta_keywords' => 'eventmie',
                'status' => 'ACTIVE',
            ])->save();
        }
        
        $page = $this->page('id', 2);
        if (!$page->exists) {
            $page->fill([
                'author_id' => 1,
                'title' => 'Privacy Policy',
                'excerpt' => 'privacy',
                'body' => 'Change privacy policy',
                'image' => NULL,
                'slug' => 'privacy',
                'meta_description' => 'Privacy Policy',
                'meta_keywords' => 'privacy',
                'status' => 'ACTIVE',
            ])->save();
        }
        
        $page = $this->page('id', 3);
        if (!$page->exists) {
            $page->fill([
                'author_id' => 1,
                'title' => 'Terms and Conditions',
                'excerpt' => 'terms',
                'body' => 'Change terms & conditions',
                'image' => NULL,
                'slug' => 'terms',
                'meta_description' => 'Terms and Conditions',
                'meta_keywords' => 'Terms and Conditions',
                'status' => 'ACTIVE',
            ])->save();
        }
    }

    protected function page($field, $for)
    {
        return Page::firstOrNew([$field => $for]);
    }
    
}