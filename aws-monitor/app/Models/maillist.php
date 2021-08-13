<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class maillist extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'maillist';

    protected $primaryKey = 'id';
    // protected $timestamps = false;
    const CREATED_AT = 'CreationDate';
    const UPDATED_AT = 'UpdateDate';

    protected $fillable = ['id','userID','stationID','status'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
   

}
