<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMembership extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_membership';

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
    protected $fillable = ['user_id','tutor_id','plan_id','amount','home_approval','expire_date'];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function tutor()
    {
        return $this->belongsTo('App\Models\TeacherProfile','tutor_id');
    }

}
