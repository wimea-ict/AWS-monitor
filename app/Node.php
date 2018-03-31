<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    //
   protected $fillable =["station_id","txt_key","mac_address"];

   public function sensors(){
       return $this->hasMany(Sensor::class);
   }
   
   public function station(){
       return $this->belongsTo(Station::class);
   }

}
