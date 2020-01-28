<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Candidates
 *
 * @property int $id
 * @property int $id_offer
 * @property int $id_candidate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Offers $Offers
 * @property-read \App\User $User
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Candidates newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Candidates newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Candidates query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Candidates whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Candidates whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Candidates whereIdCandidate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Candidates whereIdOffer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Candidates whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Offers $offers
 * @property-read \App\User $user
 */
class Candidates extends Model
{

    protected $table = "aquabe_offers_candidates";
    protected $filable = ['id_offer', 'id_user'];

    public function offers()
    {
        return $this->belongsTo('App\Offers', 'id_offer', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User',  'id_user', 'id');
    }

    public function getPostulatedAttribute($value)
    {
        $publication = $this->attributes['created_at'];

        return Carbon::parse($publication)->diffForHumans();
    }

    public function getDateAttribute() {

        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y');
    }
}
