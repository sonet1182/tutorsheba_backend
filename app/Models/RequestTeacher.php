<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestTeacher extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'student_tutors_request';

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
        'user_id','teacher_id','request_name','request_phoneNumber',
        'request_email','request_info'
    ];
}
