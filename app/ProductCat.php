<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCat extends Model
{
    protected $guarded=[];
    function product_sub_cats()
    {
        return $this->hasMany(ProductSubCat::class);
    }
    function products()
    {
        return $this->hasMany(Product::class);
    }
}
