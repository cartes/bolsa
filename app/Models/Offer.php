<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    public function business()
    {
        return $this->belongsTo(Business::class, 'id', 'id_business');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_offer')
            ->as('users');
    }

    public function benefits()
    {
        return $this->hasMany(Benefit::class);
    }
}
