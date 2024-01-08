<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedTeacher extends Model
{
    use HasFactory;

    protected $table = 'assigned_teachers';

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
        'student_id','teacher_id','assigned_by','remark'
    ];



    public function teacher()
    {
        return $this->belongsTo(User::class,'teacher_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\StudentProfile','student_id');
    }
}
