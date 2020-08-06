<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Speciality
 * @package App
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $name
 * @property string|null $description
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 * @property DateTime|null $deleted_at
 */
class Speciality extends Model
{
    use SoftDeletes;

    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Speciality::class, 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(Speciality::class, 'parent_id');
    }

    /**
     * @return BelongsToMany
     */
    public function clinics()
    {
        return $this->belongsToMany(Clinic::class);
    }
}
