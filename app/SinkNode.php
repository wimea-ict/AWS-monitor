<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class Sinknode extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sinknode';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['node_id', 'station_id', 'date_sink', 'time_sink', 'ut_sink', 'gw_lat_sink', 'gw_long_sink', 'e64_sink', 't_sink', 'ps_sink', 'up_sink', 'v_mcu_sink', 'v_in_sink', 'p_ms5611_sink', 'ttl_sink', 'rssi_sink', 'lqi_sink', 'drp_sink', 'txt_sink', 'txt_sink_value'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['date', 'date_time_recorded', 'Date', 'CreationDate'];

}
