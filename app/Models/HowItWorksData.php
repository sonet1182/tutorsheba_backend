<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HowItWorksData extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'howitworks_data';

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
    protected $fillable = ['howItWorks_title', 'howItWorks_content', 'howItWorks_type'];


}
