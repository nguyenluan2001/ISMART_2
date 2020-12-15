<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded=[];
    function setCreatedAtAtribute($value)
    {
        $this->atrribute['created_at']=new Carbon();
    }
}
