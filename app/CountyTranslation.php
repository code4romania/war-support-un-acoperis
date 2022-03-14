<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class County
 * @package App
 *
 * @property int $id
 * @property int $county_id
 * @property string $locale
 * @property string $name
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 */
class CountyTranslation extends Model
{
    public function county() {
        return $this->belongsTo(County::class, 'county_id', 'id');
    }
}
