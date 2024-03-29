<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitCount extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tutor_profile_visit_count';

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
    protected $fillable = ['tutor_id','visit_count'];


    public function tutor()
    {
        return $this->belongsTo('App\TeacherProfile','tutor_id');
    }
}
