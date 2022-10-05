<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllArea extends Model
{
    use HasFactory;

    protected $table = 'all_areas';

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
    protected $fillable = ['district_id', 'areaName'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    public function all_districts()
    {
        return $this->belongsTo(\App\AllDistrict::class, 'district_id');
    }
}
