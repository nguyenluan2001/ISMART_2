<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];
    function product_cat()
    {
        return $this->belongsTo(ProductCat::class);
    }
    function product_sub_cat()
    {
        return $this->belongsTo(ProductSubCat::class);
    }
    function detail_orders()
    {
        return $this->hasMany(DetailOrder::class);
    }
}
