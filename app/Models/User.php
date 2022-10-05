<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password','phoneNumber','password','otp','access'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function verify(){
        return $this->hasOne(UsersVerify::class,'user_id','id');
    }

    public function teacher()
    {
        return $this->hasOne(TeacherProfile::class,'user_id');
    }


    public function tuitionRequest()
    {
        return $this->hasOne(TuitionRequest::class,'user_id');
    }

    public function member()
    {
        return $this->hasOne(UserMembership::class,'user_id');
    }

    public function verification()
    {
        return $this->hasOne(Verification::class,'user_id');
    }


}
