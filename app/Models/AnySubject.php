<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnySubject extends Model
{
    use HasFactory;

    protected $table = 'any_subjects';

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
    protected $fillable = ['medium_id', 'class_id', 'subjectName'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    public function any_classes()
    {
        return $this->belongsTo(\App\AnyClass::class, 'class_id');
    }
}
