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
        's_address','t_gender','t_subject','t_days','t_salary','ex_information','time', 'manager'
    ];

     public function tuitionRequest()
    {
        return $this->hasOne('App\TuitionRequest','student_id');
    }

    public function districts()
    {
        return $this->belongsTo(AllDistrict::class,'s_districts');
    }

    public function assigned()
    {
        return $this->hasMany('App\assignedTeacher','student_id');
    }

    public function confirmed()
    {
        return $this->hasOne('App\confirmedTeacher','student_id');
    }

    public function manager_info()
    {
        return $this->belongsTo('App\Manager','manager');
    }


}
