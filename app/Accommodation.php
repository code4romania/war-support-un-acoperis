<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Accommodation
 * @package App
 *
 * @property int $id
 * @property int $user_id
 * @property int $accommodation_type_id
 * @property string $ownership_type
 * @property boolean $is_fully_available
 * @property int $max_guests
 * @property int $available_rooms
 * @property int $available_beds
 * @property int $available_bathrooms
 * @property bool $is_kitchen_available
 * @property boolean $is_parking_available
 * @property boolean $is_smoking_allowed
 * @property boolean $is_pet_allowed
 * @property string $description
 * @property int $address_country_id
 * @property int $address_county_id
 * @property string $address_city
 * @property string $address_street
 * @property string|null $address_building
 * @property string|null $address_entry
 * @property string|null $address_apartment
 * @property string|null $address_floor
 * @property string|null $address_postal_code
 * @property string|null $other_rules
 * @property string|null $transport_subway_distance
 * @property string|null $transport_bus_distance
 * @property string|null $transport_railway_distance
 * @property string|null $transport_other_details
 * @property DateTime|null $available_from_date
 * @property DateTime|null $available_to_date
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 * @property DateTime|null $deleted_at
 * @property DateTime|null $approved_at
 * @property bool $is_free
 * @property int|null $created_by
 */
class Accommodation extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    const OWNERSHIP_TYPE_OWNED = 'owned';
    const OWNERSHIP_TYPE_RENTAL = 'rental';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'available_from_date',
        'available_to_date'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_free' => 'boolean',
    ];

    /**
     * @return array
     */
    public static function getOwnershipTypes(): array
    {
        return [
            self::OWNERSHIP_TYPE_OWNED => __('Owned'),
            self::OWNERSHIP_TYPE_RENTAL => __('Rental')
        ];
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isAlreadyFull() : Bool
    {
        return $this->getOccupiedSpace() >= $this->max_guests;
    }

    public function getOccupiedSpace() : int
    {
        return $this->helpRequests->sum('guests_number');
    }

    public function helpRequests() : BelongsToMany
    {
        return $this->belongsToMany(HelpRequest::class, 'allocations', 'accommodation_id', 'help_request_id');
    }

    /**
     * @return BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function accommodationtype()
    {
        return $this->belongsTo(AccommodationType::class,  'accommodation_type_id');
    }

    /**
     * @return BelongsTo
     */
    public function addresscountry()
    {
        return $this->belongsTo(Country::class, 'address_country_id');
    }

    /**
     * @return BelongsTo
     */
    public function addresscounty()
    {
        return $this->belongsTo(County::class, 'address_county_id');
    }

    /**
     * @return BelongsToMany
     */
    public function accommodationfacilitytypes()
    {
        return $this->belongsToMany(FacilityType::class, 'accommodation_facility_type', 'accommodation_id', 'facility_type_id')
            ->withPivot(['id', 'message']);
    }

    /**
     * @return HasMany
     */
    public function photos()
    {
        return $this->hasMany(AccommodationPhoto::class);
    }

    public function bookings()
    {
        return $this->hasMany(HelpRequestAccommodationDetail::class, 'accommodation_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function availabilityIntervals()
    {
        return $this->hasMany(AccommodationsAvailabilityIntervals::class);
    }

    /**
     * @return HasMany
     */
    public function notes()
    {
        return $this
            ->hasMany(Note::class, 'entity_id')
            ->where('notes.entity_type', '=', Note::TYPE_HELP_ACCOMMODATION)
            ->orderBy('created_at');
    }

    /**
     * @return string
     */
    public function getDisplayedAddress(): string
    {
        $addressComponents = [];
        if (!empty($this->address_street)) $addressComponents[] = 'Str. ' . $this->address_street;
        if (!empty($this->address_building)) $addressComponents[] = 'Bl. ' . $this->address_building;
        if (!empty($this->address_entry)) $addressComponents[] = 'Sc. ' . $this->address_entry;
        if (!empty($this->address_apartment)) $addressComponents[] = 'Ap. ' . $this->address_apartment;
        if (!empty($this->address_floor)) $addressComponents[] = 'Et. ' . $this->address_floor;
        $addressComponents[] = $this->addresscountry->name;
        $addressComponents[] = $this->address_city;
        $addressComponents[] = $this->addresscounty->name;
        if (!empty($this->address_postal_code)) $addressComponents[] = 'Cod Postal ' . $this->address_postal_code;

        return implode(', ', $addressComponents);
    }

    public function scopeIsFree(Builder $query): Builder
    {
        return $query->where('is_free', 1);
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->whereNotNull('approved_at');
    }

    public function isApproved(): bool
    {
        return !!$this->approved_at;
    }

    public function canBeDeleted(): bool
    {
        //todo should be verified
        /**
         * @var User $user
         */
        $user = Auth::user();
        return $this->user_id === $user->id || $user->isAdministrator();
    }

    public function canBeEdited(): bool
    {
        //todo should be verified
        /**
         * @var User $user
         */
        $user = Auth::user();
        return $this->user_id === $user->id || $user->isAdministrator();
    }
}
