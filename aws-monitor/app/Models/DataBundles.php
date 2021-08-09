<?php

namespace station\Models;
use Illuminate\Database\Eloquent\Model;

class DataBundles extends Model
{
    public function station()
    {
        return $this->belongsTo(Station::class, "station_id");
    }
}
