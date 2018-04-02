<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class Observationslip extends Model
{
    /**
     * The table associated with the model
     * 
     * @var string
     */
    protected $table = 'observationslip';

    /**
     * Indicates if the model should be timestamped
     * 
     * @var bool
     */
    public $timestamps = false;

    const CREATED_AT = 'CreationDate';
    //
}
