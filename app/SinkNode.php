<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class SinkNode extends Model
{
    /**
     * The table associated with the model
     * 
     * @var string
     */
    protected $table = 'sinkNode';

    /**
     * Indicates if the model should be timestamped
     * 
     * @var bool
     */
    // public $timestamps = false;

    // const CREATED_AT = 'CreationDate';
    //
            protected $fillable = ['station_id','date_sink','time_sink',
            'ut_sink','gw_lat_sink','gw_long_sink','v_mcu_sink','v_in_sink',
            'ttl_sink','rssi_sink','lqi_sink','drp_sink','e64_sink','txt_sink',
            'p_ms5611_sink','v_in_min_value','v_in_max_value','v_mcu_min_value',
            'v_mcu_max_value','ps_sink','up_sink','t_sink','node_status',
            'txt_value_sink'];
}
