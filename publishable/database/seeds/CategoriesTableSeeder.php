<?php

use Illuminate\Database\Seeder;
use Classiebit\Eventmie\Models\Category;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $category = Category::count();
        if($category) 
            return true;

        $category = $this->category('id', 1);
        if (!$category->exists) {
            $category->fill([
                'name' => 'Business & Seminars',
                'slug' => 'business-&-seminars',
                'status' => 1,
                'thumb' => 'categories/September2019/qXRVg2PfJlS58FgCocap.jpg',
                'image' => NULL,
                'template' => 1,
                'created_at' => '2019-09-02 06:26:33',
                'updated_at' => '2019-10-05 06:01:50',
            ])->save();
        }
    }
    
    protected function category($field, $for)
    {
        return Category::firstOrNew([$field => $for]);
    }
}