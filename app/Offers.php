<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Offers
 *
 * @property int $id
 * @property int $id_business
 * @property string $title
 * @property string $description
 * @property int $handicapped
 * @property string $area
 * @property string $sub_area
 * @property string $address
 * @property string $city
 * @property string $comune
 * @property string $state
 * @property int|null $salary
 * @property string $position
 * @property string|null $benefits
 * @property string|null $requirements
 * @property int $period
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Business $Business
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Candidates[] $Candidates
 * @property-read int|null $candidates_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereBenefits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereHandicapped($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereIdBusiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereSubArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Business $business
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Candidates[] $candidates
 * @property string|null $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereStatus($value)
 * @property string $country
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereCountry($value)
 * @property string|null $slug
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $User
 * @property-read int|null $user_count
 * @property-read \App\BusinessMeta $businessMeta
 * @property-read mixed $date
 * @property-read mixed $publication
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Offers onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereComune($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Offers withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Offers withoutTrashed()
 */
class Offers extends Model
{
    use SoftDeletes;
    /**
     * @var string
     */
    protected $table = "aquabe_offers";
    protected $withCount = ['candidates'];
    protected $fillable = ['id_business', 'title', 'slug', 'description', 'handicapped', 'area', 'sub_area', 'address', 'country', 'city', 'state', 'salary', 'position', 'benefits', 'requirements', 'period', 'status'];

    public function business()
    {
        return $this->belongsTo('App\Business', 'id_business', 'id');
    }

    public function candidates()
    {
        return $this->hasMany('App\Candidates', 'id_offer', 'id');
    }

    public function User() {
        return $this->belongsToMany('App\User');
    }

    public function businessMeta()
    {
        return $this->belongsTo('App\BusinessMeta', 'id_business', 'id_business');
    }

    public function getPublicationAttribute()
    {
        $publication = $this->attributes['created_at'];

        return Carbon::parse($publication)->diffForHumans();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getDateAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y');
    }
}
