<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'student_profile';

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
        'title','s_fullName','s_phoneNumber','s_email','s_number',
        's_gender','s_college','s_class','s_medium','s_districts','s_area',
        's_address','t_gender','t_subject','t_days','t_salary','ex_information','time', 'manager',
        'lead_generator'
    ];

    public function tuitionRequest()
    {
        return $this->hasOne('App\Models\TuitionRequest','student_id');
    }

    public function districts()
    {
        return $this->belongsTo(AllDistrict::class,'s_districts');
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class,'lead_generator');
    }

    public function guardian()
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function area()
    {
        return $this->belongsTo(AllArea::class,'s_area');
    }

    public function assigned()
    {
        return $this->hasMany('App\Models\AssignedTeacher','student_id');
    }

    public function confirmed()
    {
        return $this->hasOne('App\Models\confirmedTeacher','student_id');
    }

    public function confirmedtutor()
    {
        return $this->hasOneThrough(
            'App\Models\TeacherProfile', 
            'App\Models\confirmedTeacher', 
            'student_id',  // Foreign key on Confirmed table
            'user_id',          // Foreign key on TutorProfile table
            'id',          // Local key on StudentProfile table
            'teacher_id'   // Local key on Confirmed table
        );
    }

    public function manager_info()
    {
        return $this->belongsTo('App\Models\Manager','manager');
    }

    public function txn()
    {
        return $this->hasOne('App\Models\Afftransaction','lead_id');
    }


}
