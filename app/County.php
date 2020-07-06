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
 */
class County extends Model
{
    /**
     * @return HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
