<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class TwoMeterNode extends Model
{
    protected $fillable = ['station_id','date_2m','node_status','time_2m','ut_2m','gw_lat_2m','gw_long_2m','v_mcu_2m','v_in_2m','ttl_2m','rssi_2m','lqi_2m','drp_2m','e64_2m','txt_2m','t_sht2x_2m','v_in_min_value','v_in_max_value','v_mcu_min_value','v_mcu_max_value','t_sht2x_2m','rh_sh2x_2m','txt_value2m'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['date', 'date_time_recorded', 'Date', 'CreationDate', 'Opened', 'Closed', 'CreationDate'];

}
