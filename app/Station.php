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
>>>>>>> 24f6d5374d5eee5f07465fc9e76e26003c2819b6

}
