<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transactions';

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


    public function transaction()
    {
        return $this->belongsTo('App\Models\confirmedTeacher','confirmation_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class,'teacher_id');
    }

}
