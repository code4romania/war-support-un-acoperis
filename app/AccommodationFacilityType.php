<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class AccommodationFacilityType
 * @package App
 *
 * @property int $id
 * @property int $accommodation_id
 * @property int $facility_type_id
 * @property string $message
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 */
class AccommodationFacilityType extends Model
{
    /**
     * @return BelongsTo
     */
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }

    /**
     * @return BelongsTo
     */
    public function facilitytype()
    {
        return $this->belongsTo(FacilityType::class);
    }
}
