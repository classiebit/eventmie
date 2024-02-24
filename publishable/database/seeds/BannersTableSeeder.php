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
        $banner = Banner::count();
        if($banner) 
            return true;

        $banner = $this->banner('id', 1);
        if (!$banner->exists) {
            $banner->fill([
                'title' => 'Eventmie Lite',
                'subtitle' => 'Free Event management & booking platform',
                'image' => 'banners/November2023/A8XifDakbgJ3B3zgKzWD.webp',
                'status' => 1,
                'created_at' => '2024-01-25 09:50:13',
                'updated_at' => '2024-01-25 05:32:44',
            ])->save();
        }
        
    }

    protected function banner($field, $for)
    {
        return Banner::firstOrNew([$field => $for]);
    }
}