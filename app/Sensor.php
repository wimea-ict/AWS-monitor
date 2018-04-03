<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    //
    protected $fillable = ['node_id','parameter_read','identifier_used','min_value','max_value','node_type','report_time_interval'];
}
