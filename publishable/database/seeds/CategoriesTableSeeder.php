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
        $category = $this->category('id', 1);
        if (!$category->exists) {
            $category->fill([
                'id'    => 1,
                'name' => 'Business & Seminars',
                'slug' => 'business-&-seminars',
                'created_at' => '2019-09-02 06:26:33',
                'updated_at' => '2019-10-05 06:01:50',
                'status' => 1,
                'thumb' => 'categories/October2019/oJbtSjHLoCcSEPva4IJe.jpg',
                'image' => NULL,
                'template' => 1,
            ])->save();
        }
    }

    protected function category($field, $for)
    {
        return Category::firstOrNew([$field => $for]);
    }
}