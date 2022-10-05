<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllDistrict extends Model
{
    use HasFactory;

    protected $table = 'all_districts';

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
    protected $fillable = ['districtName'];

    //  public function teacher()
    // {
    //     return $this->hasMany('App\TeacherProfile','district_id');
    // }
}
