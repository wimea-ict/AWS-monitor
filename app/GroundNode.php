<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class GroundNode extends Model
{
    /**
     * The table associated with the model
     * 
     * @var string
     */
    protected $table = 'groundNode';

    /**
     * Indicates if the model should be timestamped
     * 
     * @var bool
     */
    public $timestamps = false;

    const CREATED_AT = 'CreationDate';
    //
        
    protected $fillable = ['station_id','date_gnd','time_gnd','ps_gnd','up_gnd',
    'po_lst60_gnd','ut_gnd','gw_lat_gnd','gw_long_gnd','v_mcu_gnd',
    'v_in_gnd','ttl_gnd','rssi_gnd','lqi_gnd','drp_gnd','e64_gnd','txt_gnd',
    'txt_value_gnd','v_in_min_value','v_in_max_value','v_mcu_min_value',
    'v_mcu_max_value','v_a1_gnd','v_a2_gnd','node_status'];

}
