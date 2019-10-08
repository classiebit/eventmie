<?php

namespace Classiebit\Eventmie\Models;

use Illuminate\Database\Eloquent\Model;


class Contact extends Model
{
    protected $guarded = [];

    // save contact details
    public function store_contact($data = [])
    {
        return Contact::create($data);
    }

}    