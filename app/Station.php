<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
<<<<<<< HEAD
    
    protected $fillable=["station_name","station_location","longitude",
                        "latitude","station_number","location","city","region",
                        "date_opened","date_closed"];


    public function nodes(){
       return $this->hasMany(Node::class);
   }
=======
    protected $primaryKey = 'station_id';
    protected $fillable = ['station_name','station_location','longitude','latitude','station_number','station_type','city','region','code','date_opened','date_closed'];
>>>>>>> c74096c27d46aa298943fc215473d7b325a29b78

}
