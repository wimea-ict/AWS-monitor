<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    
    protected $primaryKey = 'station_id';
    protected $fillable = ['station_name','station_location','longitude','latitude','station_number','station_type','city','region','code','date_opened','date_closed'];

    

    public function nodes(){
       return $this->hasMany(Node::class);
   }
    
}
