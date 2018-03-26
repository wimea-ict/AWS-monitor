<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class NodeStatus extends Model
{
    
    protected $fillable=["node_id","v_in","rssi","drop","vmcu","lqi","date_time"];

    
}
