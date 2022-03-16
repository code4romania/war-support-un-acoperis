<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class AccommodationsAvailabilityIntervals
 *
 * @package App
 *
 * @property int       $id
 * @property int       $accommodation_id
 * @property \DateTime $from_date
 * @property \DateTime $to_date
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 *
 */
class AccommodationsAvailabilityIntervals extends Model
{
    public function accommodation(): BelongsTo
    {
        return $this->belongsTo(Accommodation::class, 'accommodation_id', 'id');
    }

    public function scopeWhereDateStrictBetween(Builder $query, Carbon $fromDate, Carbon $toDate): Builder
    {
        return $query->where('from_date', '<=', $fromDate)
                     ->where('to_date', '>=', $fromDate)
                     ->where('to_date', '>=', $toDate);
    }
}
