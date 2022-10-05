<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class confirmedTeacher extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'confirmed_teachers';

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
    protected $guarded = [];



    public function teacher()
    {
        return $this->belongsTo(User::class,'teacher_id');
    }

    public function student()
    {
        return $this->belongsTo('App\StudentProfile','student_id');
    }

    public function transaction()
    {
        return $this->hasMany('App\Transaction','confirmation_id');
    }
}
