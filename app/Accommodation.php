<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property int $available_bathrooms
 * @property bool $is_kitchen_available
 * @property boolean $is_parking_available
 * @property boolean $is_smoking_allowed
 * @property boolean $is_pet_allowed
 * @property string $description
 * @property int $address_country_id
 * @property string $address_city
 * @property string $address_street
 * @property string|null $address_building
 * @property string|null $address_entry
 * @property string|null $address_apartment
 * @property string|null $address_floor
 * @property string|null $address_postal_code
 * @property string|null $other_rules
 * @property boolean $is_free
 * @property string|null $general_fee
 * @property string|null $transport_subway_distance
 * @property string|null $transport_bus_distance
 * @property string|null $transport_railway_distance
 * @property string|null $transport_other_details
 * @property string|null $checkin_time
 * @property string|null $checkout_time
 * @property DateTime|null $unavailable_from_date
 * @property DateTime|null $unavailable_to_date
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 * @property DateTime|null $deleted_at
 */
class Accommodation extends Model
{
    use SoftDeletes;

    const OWNERSHIP_TYPE_OWNED = 'owned';
    const OWNERSHIP_TYPE_RENTAL = 'rental';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'unavailable_from_date',
        'unavailable_to_date'
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

    /**
     * @return HasMany
     */
    public function notes()
    {
        return $this
            ->hasMany(Note::class, 'entity_id')
            ->where('notes.entity_type', '=', Note::TYPE_HELP_ACCOMMODATION);
    }
}
