<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class DataBundles extends Model
{
    public function station(){
        return $this->belongsTo(Station::class);
    }
}
