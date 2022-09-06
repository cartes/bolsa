<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name',
        'surname',
        'email',
        'password',
        'rut_user',
        'nacionality',
        'marital_status',
        'gender',
        'birthday'
    ];

    protected $hidden = ['password', 'remember_token'];
    protected $table = 'users';
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Offers()
    {
        return $this->belongsToMany(Offer::class, 'user_offer')->as('offers');
    }

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }

    public function userMeta()
    {
        return $this->hasOne(UserMeta::class);
    }

    public function EducationItems()
    {
        return $this->hasMany(UserEducation::class);
    }

    public function ExperienceItems()
    {
        return $this->hasMany(UserExperience::class);
    }

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->surname;
    }
}
