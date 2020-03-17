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
 * @property string|null $experience
 * @property string|null $views
 * @property string|null $expirated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Benefit[] $Benefits
 * @property-read int|null $benefits_count
 * @property-read mixed $expiration_date
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereExpiratedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereViews($value)
 * @property int|null $featured
 * @property-read mixed $is_new
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Message[] $messages
 * @property-read int|null $messages_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offers whereFeatured($value)
 */
class Offers extends Model
{
    use SoftDeletes;

    const REVIEWED = 1;
    const INTERVIEW = 2;

    /**
     * @var string
     */
    protected $table = "aquabe_offers";
    protected $withCount = ['candidates'];
    protected $fillable = [
        'id_business',
        'title',
        'slug',
        'description',
        'handicapped',
        'area',
        'sub_area',
        'address',
        'country',
        'city',
        'state',
        'commune',
        'salary',
        'position',
        'experience',
        'views',
        'requirements',
        'period',
        'status',
        'expirated_at'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'id_business', 'id');
    }

    public function candidates()
    {
        return $this->hasMany(Candidates::class, 'id_offer', 'id');
    }

    public function User()
    {
        return $this->belongsToMany('App\User');
    }

    public function Benefits()
    {
        return $this->hasMany(Benefit::class, 'offer_id', 'id');
    }

    public function businessMeta()
    {
        return $this->belongsTo(BusinessMeta::class, 'id_business', 'id_business');
    }

    public function messages()
    {
        return $this->hasMany( Message::class );
    }

    public function getPublicationAttribute()
    {
        $publication = $this->attributes['created_at'];

        return Carbon::parse($publication)->diffForHumans();
    }

    public function getIsNewAttribute() {
        $publication = $this->attributes['created_at'];
        if (Carbon::parse($publication)->diffInHours() < 20) {
            return true;
        } else {
            return false;
        }
    }

    public function getCreatedAtAttribute()
    {
        $publication = $this->attributes['created_at'];
        return Carbon::parse($publication)->format("d F Y");
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getDateAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y');
    }

    public function getExpirationDateAttribute()
    {
        $starts = Carbon::parse($this->attributes['expirated_at']);
        return $starts->format('d/m/Y');
    }

    public function getStatusAttribute()
    {
        $expiration = Carbon::parse($this->attributes['expirated_at']);

        if ($expiration < Carbon::now()) {
            return '<i class="fas fa-minus-circle text-danger" data-toggle="popover" data-content="Oferta expirada" data-trigger="hover"></i>';
        } elseif ($expiration <= Carbon::now()->addDays(2)) {
            return '<i class="fas fa-minus-circle text-danger" data-toggle="popover" data-content="Oferta a punto de expirar" data-trigger="hover"></i>';
        } elseif ($expiration <= Carbon::now()->addDays(7)) {
            return '<i class="fas fa-exclamation-circle text-warning" data-toggle="popover" data-content="Oferta expira en menos de 7 días" data-trigger="hover"></i>';
        } else {
            return '<i class="fas fa-check-circle text-success"></i>';
        }
    }
}
