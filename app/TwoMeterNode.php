<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Twometernode extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'twometernode';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['node_id', 'station_id', 'date_2m', 'time_2m', 'ut_2m', 'gw_lat_2m', 'gw_long_2m', 'v_mcu_2m', 'v_in_2m', 'ttl_2m', 'rssi_2m', 'lqi_2m', 'drp_2m', 'e64_2m', 'txt_2m', 't_sht2x_2m', 'rh_sh2x_2m', 'txt_2m_value'];

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
    protected $dates = ['date', 'date_time_recorded', 'Date', 'CreationDate', 'Opened', 'Closed', 'CreationDate'];

}