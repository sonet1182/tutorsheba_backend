<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'verification';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','profile_verification_request','profile_verification_status'
    ];

     public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }


}
