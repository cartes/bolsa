<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Business
 *
 * @property int $id
 * @property string $rut_user
 * @property string $password
 * @property string $firstname
 * @property string $surname
 * @property string $email
 * @property string $position
 * @property string $phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\BusinessMeta $business_meta
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Offers[] $offers
 * @property-read int|null $offers_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Business newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Business newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Business query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Business whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Business whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Business whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Business whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Business wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Business wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Business wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Business whereRutUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Business whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Business whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Business extends Model
{

    /**
     * @var string
     */
    protected $table = "aquabe_business";

    public function business_meta()
    {
        return $this->hasOne('App\BusinessMeta', 'id_business', 'id');
    }

    public function offers()
    {
        return $this->hasMany('App\Offers', 'id_business', 'id');
    }
}
