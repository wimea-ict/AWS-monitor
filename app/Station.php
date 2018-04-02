<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    /**
     * The table associated with the model
     * 
     * @var string
     */
    protected $table = 'stations';

    /**
     * Indicates if the model should be timestamped
     * 
     * @var bool
     */
    // public $timestamps = false;

    // const CREATED_AT = 'CreationDate';

    protected $primaryKey = 'station_id';
    protected $fillable = ['station_name','station_location','longitude','latitude','station_number','station_type','city','region','code','date_opened','date_closed'];

}
