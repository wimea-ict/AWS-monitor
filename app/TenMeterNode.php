<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class TenMeterNode extends Model
{
    protected $fillable = ['station_id','date_10m','time_10m','ps_10m','ut_10m','gw_lat_10m','gw_long_10m','v_mcu_10m','v_in_10m','ttl_10m','rssi_10m','lqi_10m','drp_10m','e64_10m','txt_10m','v_in_min_value','v_in_max_value','v_mcu_min_value','v_mcu_max_value','v_a1_10m','v_a2_10m','v_a3_10m','node_status','txt_value_10m'];

}
