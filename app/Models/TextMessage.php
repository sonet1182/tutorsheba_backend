<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextMessage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'text_messages';

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
        'user_id','message','status'
    ];

     public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }


}
