<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $fillable=["problem_id","datetime","message","report_counter","App_id","node","sensor"];
    public $timestamps = false;
}
