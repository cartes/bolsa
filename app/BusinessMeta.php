<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\BusinessMeta
 *
 * @property int $id
 * @property int $id_business
 * @property string $rut_business
 * @property string $business_name
 * @property string $fantasy_name
 * @property string $activity
 * @property string $address
 * @property string $comune
 * @property string $city
 * @property string $state
 * @property string $phone
 * @property string $logo
 * @property string $entry
 * @property int $employees
 * @property string $rotation
 * @property-read \App\Business $business
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta whereActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta whereBusinessName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta whereComune($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta whereEmployees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta whereEntry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta whereFantasyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta whereIdBusiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta whereRotation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta whereRutBusiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta whereState($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BusinessMeta whereUpdatedAt($value)
 */
class BusinessMeta extends Model
{
    use SoftDeletes;

    protected $table = "aquabe_business_meta";
    protected $fillable = ['id_business', 'rut_business', 'business_name', 'fantasy_name', 'activity', 'address', 'comune', 'city', 'state', 'phone', 'logo', 'entry', 'employees', 'rotation'];

    public function business()
    {
        return $this->belongsTo('App\Business', 'id', 'id_business');
    }

    public function offers()
    {
        return $this->hasMany('App\Offers', 'id_business', 'id_business');
    }
}
