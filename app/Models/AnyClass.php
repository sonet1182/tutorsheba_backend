<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnyClass extends Model
{
    use HasFactory;

    protected $table = 'any_classes';

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
    protected $fillable = ['medium_id', 'className'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    public function all_media()
    {
        return $this->belongsTo(\App\AllMedium::class, 'medium_id');
    }
}
