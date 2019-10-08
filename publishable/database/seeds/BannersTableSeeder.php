<?php

use Illuminate\Database\Seeder;
use Classiebit\Eventmie\Models\Banner;

class BannersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $banner = $this->banner('id', 1);
        if (!$banner->exists) {
            $banner->fill([
                'id' => 1,
                'title' => 'Event Planning Platform Reimagined',
                'subtitle' => 'Laravel 2020',
                'image' => 'banners/August2019/3MIAC8BaLwk8ytlYYvVi.jpg',
                'status' => 1,
                'created_at' => '2019-08-31 09:50:13',
                'updated_at' => '2019-10-05 05:32:44',
            ])->save();
        }
    }

    protected function banner($field, $for)
    {
        return Banner::firstOrNew([$field => $for]);
    }
}