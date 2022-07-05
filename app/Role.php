<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "aquabe_roles";

    protected $fillable = ['id_business', 'role'];

    public function business()
    {
        return $this->belongsTo(Business::class, 'id', 'id_business');
    }
}
