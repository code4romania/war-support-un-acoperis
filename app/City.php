<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class City
 * @package App
 *
 * @property int $id
 * @property int $county_id
 * @property string $name
 * @property string $short_name
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 */
class City extends Model
{
    /**
     * @return BelongsTo
     */
    public function county()
    {
        return $this->belongsTo(County::class);
    }
}
