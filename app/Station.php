<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    
    protected $fillable=["station_name","station_location","longitude",
                        "latitude","station_number","location","city","region",
                        "date_opened","date_closed"];


    public function nodes(){
       return $this->hasMany(Node::class);
   }

}
