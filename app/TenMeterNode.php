<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenmeternode extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tenmeternode';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['node_id', 'station_id', 'date_10m', 'time_10m', 'ut_10m', 'gw_lat_10m', 'gw_long_10m', 'e64_10m', 'ps_10m', 'v_mcu_10m', 'v_in_10m', 'v_a1_10m', 'v_a2_10m', 'v_a3_10m', 'ttl_10m', 'rssi_10m', 'lqi_10m', 'drp_10m', 'txt_10m', 'txt_10m_value'];

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