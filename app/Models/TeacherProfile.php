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
    protected $guarded = [];

    // protected $with = ['districts'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function districts()
    {
        return $this->belongsTo(AllDistrict::class, 'district_id');
    }

    public function owndistricts()
    {
        return $this->belongsTo(AllDistrict::class, 'teacher_present_city');
    }

    public function member()
    {
        return $this->hasOne('App\UserMembership', 'tutor_id');
    }

    public function institype()
    {
        return $this->belongsTo(Institype::class, 'honours_insti_type');
    }

    public function studytype()
    {
        return $this->belongsTo(Studytype::class, 'honours_study_type');
    }

    public function verify()
    {
        return $this->belongsTo(UsersVerify::class, 'user_id', 'user_id');
    }



    public function calculateProfilePercentage()
    {
        $point = 0;

        $point += $this->teacher_university ? 0 : 0;
        $point += $this->teacher_subject ? 1 : 0;
        $point += $this->teacher_degree ? 1 : 0;
        $point += $this->teacher_profile_picture ? 10 : 0;
        $point += $this->teacher_gender ? 4 : 0;
        $point += $this->teacher_bk_medium ? 1 : 0;
        $point += $this->teacher_present_address ? 3 : 0;
        $point += $this->teacher_permanent_address ? 3 : 0;

        $point += $this->ssc_year ? 1 : 0;
        $point += $this->ssc_institute ? 1 : 0;
        $point += $this->ssc_group ? 1 : 0;
        $point += $this->ssc_gpa ? 1 : 0;
        $point += $this->ssc_curriculam ? 1 : 0;

        $point += $this->hsc_year ? 2 : 0;
        $point += $this->hsc_institute ? 2 : 0;
        $point += $this->hsc_group ? 2 : 0;
        $point += $this->hsc_gpa ? 2 : 0;
        $point += $this->hsc_curriculam ? 2 : 0;

        $point += $this->honours_insti_type ? 5 : 0;
        $point += $this->honours_study_type ? 5 : 0;
        $point += $this->honours_year ? 5 : 0;
        $point += $this->honours_institute ? 5 : 0;
        $point += $this->honours_subject ? 5 : 0;
        $point += $this->honours_gpa ? 5 : 0;
        $point += $this->honours_curriculam ? 2 : 0;

        $point += $this->district_id ? 4 : 0;
        $point += $this->tution_area ? 4 : 0;
        $point += $this->tution_subject ? 3 : 0;
        $point += $this->tution_medium ? 3 : 0;
        $point += $this->tution_class ? 3 : 0;
        $point += $this->tution_days ? 3 : 0;
        $point += $this->tution_shift ? 3 : 0;
        $point += $this->tution_salery ? 3 : 0;
        $point += $this->tution_style ? 3 : 0;
        $point += $this->tution_experience ? 3 : 0;
        $point += $this->about_yourself ? 4 : 0;
        $point += $this->father_name ? 2 : 0;
        $point += $this->father_phone ? 2 : 0;
        $point += $this->mother_name ? 2 : 0;
        $point += $this->mother_phone ? 2 : 0;
        $point += optional($this->verify)->nid_card ? 7 : 0;
        $point += optional($this->verify)->student_card ? 7 : 0;

        return $point;
    }


}
