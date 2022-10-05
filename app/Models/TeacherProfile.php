<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherProfile extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teacher_profile';

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
        'home_approval','approval','teacher_id',
        'teacher_profile_picture',
        'user_id','teacher_name','a_phone_number',
        'teacher_gender','teacher_university',
        'teacher_subject','teacher_degree',
        'teacher_bk_medium','teacher_present_address',
        'teacher_permanent_address','ssc_year',
        'ssc_institute','ssc_group','ssc_gpa','hsc_year','hsc_institute',
        'hsc_group','hsc_gpa','honours_year','honours_institute','honours_subject',
        'honours_gpa',
        'district_id','tuition_area','tuition_subject','tuition_medium',
        'tuition_class','tuition_days','tuition_shift','tuition_style','tuition_salary',
        'tuition_experience','about_yourself','balance','prog'
    ];

     public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function districts()
    {
        return $this->belongsTo(AllDistrict::class,'district_id');
    }

    public function member()
    {
        return $this->hasOne('App\UserMembership','tutor_id');
    }

}
