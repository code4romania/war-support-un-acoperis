<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Country
 * @package App
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 */
class Country extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'name'];

    /**
     * @return HasMany
     */
    public function clinics()
    {
        return $this->hasMany(Clinic::class);
    }
}
