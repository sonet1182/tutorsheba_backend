<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TuitionRequest extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teacher_tuition_request';

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
    protected $fillable = ['tuition_id','teacher_id'];

     public function teacher()
    {
        return $this->belongsTo(User::class,'user_id');
    }

     public function profile()
    {
        return $this->belongsTo('App\Models\TeacherProfile','user_id', 'user_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\StudentProfile','student_id');
    }
}
