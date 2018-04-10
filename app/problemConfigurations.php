<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class problemConfigurations extends Model
{
    protected $fillable = ['station_id','problem_id','investigation_hours','report_method','criticality','reporting_time_interval'];
    
}
