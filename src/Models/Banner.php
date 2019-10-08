<?php

namespace Classiebit\Eventmie\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $guarded = [];

    public function get_banners()
    {
        return Banner::where(['status' => 1])->orderBy('id', 'asc')->get();
    }

}    