<?php

use Illuminate\Database\Seeder;
use Classiebit\Eventmie\Models\Page;

class PagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $page = $this->page('id', 1);
        if (!$page->exists) {
            \DB::table('pages')->insert(array (
                0 => 
                array (
                    'id' => 1,
                    'author_id' => 1,
                    'title' => 'About Us',
                    'excerpt' => 'about',
                    'body' => 'This is about us',
                    'image' => NULL,
                    'slug' => 'about',
                    'meta_description' => 'About us description',
                    'meta_keywords' => 'eventmie',
                    'status' => 'ACTIVE',
                    'created_at' => '2018-12-21 10:25:08',
                    'updated_at' => '2019-08-22 06:45:56',
                ),
                1 => 
                array (
                    'id' => 2,
                    'author_id' => 1,
                    'title' => 'Privacy Policy',
                    'excerpt' => 'privacy',
                    'body' => 'This is privacy policy',
                    'image' => NULL,
                    'slug' => 'privacy',
                    'meta_description' => 'Privacy Policy',
                    'meta_keywords' => 'privacy',
                    'status' => 'ACTIVE',
                    'created_at' => '2019-07-07 07:48:28',
                    'updated_at' => '2019-08-22 06:43:16',
                ),
                2 => 
                array (
                    'id' => 3,
                    'author_id' => 1,
                    'title' => 'Terms and Conditions',
                    'excerpt' => 'terms',
                    'body' => 'These are Terms and Conditions',
                    'image' => NULL,
                    'slug' => 'terms',
                    'meta_description' => 'Terms and Conditions',
                    'meta_keywords' => 'Terms and Conditions',
                    'status' => 'ACTIVE',
                    'created_at' => '2019-07-07 07:48:58',
                    'updated_at' => '2019-10-04 10:56:26',
                ),
            ));
        }
        
    }

    protected function page($field, $for)
    {
        return Page::firstOrNew([$field => $for]);
    }
}