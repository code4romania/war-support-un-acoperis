<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Accommodation
 * @package App
 *
 * @property int $id
 * @property int $accommodation_type_id
 * @property int $ownership_type
 * @property boolean $is_fully_available
 * @property int $max_guests
 * @property int $available_rooms
 * @property boolean $is_parking_available
 * @property boolean $is_smoking_allowed
 * @property boolean $is_pet_allowed
 * @property string $description
 * @property int $address_country_id
 * @property string $address_city
 * @property string $address_street
 * @property string $address_building
 * @property string $address_entry
 * @property string $address_apartment
 * @property string $address_floor
 * @property string $address_postal_code
 * @property string $other_rules
 * @property boolean $is_free
 * @property string $phone_number
 * @property string $transport_subway_distance
 * @property string $transport_bus_distance
 * @property string $transport_railway_distance
 * @property string $transport_other_details
 * @property DateTime $checkin_hour
 * @property DateTime $checkout_hour
 * @property string $general_fee
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 * @property DateTime|null $deleted_at
 */
class Accommodation extends Model
{
    /**
     * @return BelongsTo
     */
    public function accommodationtype()
    {
        return $this->belongsTo(AccommodationType::class);
    }

    /**
     * @return BelongsTo
     */
    public function addresscountry()
    {
        return $this->belongsTo(Country::class);
    }
}
