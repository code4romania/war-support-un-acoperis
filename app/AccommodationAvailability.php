<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class AccommodationAvailability
 * @package App
 *
 * @property int $id
 * @property int $accommodation_id
 * @property DateTime $start_date
 * @property DateTime $end_date
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 * @property DateTime|null $deleted_at
 */
class AccommodationAvailability extends Model
{
    /**
     * @return BelongsTo
     */
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}
