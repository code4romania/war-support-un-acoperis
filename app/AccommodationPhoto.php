<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class AccommodationPhoto
 * @package App
 *
 * @property int $id
 * @property int $accommodation_id
 * @property string $name
 * @property string $path
 * @property int $size
 * @property string|null $extension
 * @property string|null $type
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 * @property DateTime|null $deleted_at
 */
class AccommodationPhoto extends Model
{
    /**
     * @return BelongsTo
     */
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}
