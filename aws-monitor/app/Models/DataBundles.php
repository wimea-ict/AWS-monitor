<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DataBundles extends Model
{
    public function App()
    {
        return $this->belongsTo(Station::class, "App_id");
    }
}
