<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $fillable = ['station_name','station_location','longitude','latitude','station_number','station_type','city','region','code','date_opened','date_closed'];

}
