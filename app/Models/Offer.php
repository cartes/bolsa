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

    public function getPostuledAttribute()
    {
        $id_user = auth()->id();
        $id_offer = $this->id;
        if (is_null($id_user)) {
            return false;
        }
        return false;
    }
}
