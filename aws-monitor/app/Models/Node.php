<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    /**
     * The table associated with the model
     * 
     * @var string
     */
    // protected $table = 'observationslip';

    /**
     * Indicates if the model should be timestamped
     * 
     * @var bool
     */
    // public $timestamps = false;

    // const CREATED_AT = 'CreationDate';
    
    //
   protected $fillable =["App_id","txt_key","mac_address"];

   public function sensors(){
       return $this->hasMany(Sensor::class);
   }
   
   public function App(){
       return $this->belongsTo(Station::class);
   }

}
