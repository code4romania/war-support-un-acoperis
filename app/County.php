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
 * @property string $name
 * @property string $code
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 * @property array $translations
 */
class County extends Model
{

    public function translations() {
        return $this->hasMany(CountyTranslation::class, 'county_id', 'id');
    }
    /**
     * @return HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    /**
     * @return HasMany
     */
    public function helprequests()
    {
        return $this->hasMany(HelpRequest::class);
    }
}
