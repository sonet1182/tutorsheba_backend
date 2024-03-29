<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersVerify extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_verify';

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
    protected $fillable = ['user_id','nid_card','student_card'];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
