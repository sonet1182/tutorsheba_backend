<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rejectedTeacher extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rejected_teachers';

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
        'student_id','teacher_id','rejected_by','reason'
    ];



    public function teacher()
    {
        return $this->belongsTo(User::class,'teacher_id');
    }

    public function student()
    {
        return $this->belongsTo('App\StudentProfile','student_id');
    }
}