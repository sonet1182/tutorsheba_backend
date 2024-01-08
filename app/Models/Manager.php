<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Manager extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'managers';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function tutor()
    {
        return $this->belongsTo('App\Models\TeacherProfile','tutor_id');
    }
}
