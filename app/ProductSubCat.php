<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSubCat extends Model
{
    protected $guarded=[];
    function product_cat()
    {
        return $this->belongsTo(ProductCat::class);
    }
    function products()
    {
        return $this->hasMany(Product::class);
    }
}
