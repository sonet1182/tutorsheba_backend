<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivacyPolicyData extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'privacy_policy';

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
    protected $fillable = ['privacy_title', 'privacy_content'];


}
