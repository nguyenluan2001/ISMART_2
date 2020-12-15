<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];
    function detail_orders()
    {
        return $this->hasMany(DetailOrder::class);
    }
}
