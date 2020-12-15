<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    function province()
    {
        return $this->belongsTo(Province::class);
    }
    function wards()
    {
        return $this->hasMany(Ward::class);
    }
}
