<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class Groundnode extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'groundNode';

    protected $primaryKey = 'node_id';
    // protected $timestamps = false;
    const CREATED_AT = 'CreationDate';
    const UPDATED_AT = 'UpdateDate';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['station_id','date_gnd','time_gnd','ps_gnd','up_gnd', 'p0_lst60_gnd','ut_gnd','gw_lat_gnd','gw_long_gnd','v_mcu_gnd', 'v_in_gnd','ttl_gnd','rssi_gnd','lqi_gnd','drp_gnd','e64_gnd','txt_gnd', 'txt_gnd_value','v_in_min_value','v_in_max_value','v_mcu_min_value', 'v_mcu_max_value','v_a1_gnd','v_a2_gnd','node_status', 'CreationDate','UpdateDate'];

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
    protected $dates = [];

}
