<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $fillable=["problem_id","datetime","message","report_counter"];
    public $timestamps = false;
}
