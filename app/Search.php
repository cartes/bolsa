<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{

    protected $table = "aquabe_searches";
    protected $fillable = ['search_term', 'user_id', 'quantity'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
