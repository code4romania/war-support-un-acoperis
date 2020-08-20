<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

/**
 * Class HelpResource
 * @package App
 *
 * @property int $id
 * @property string $full_name
 * @property int $country_id
 * @property string $city
 * @property string|null $address
 * @property string|null $phone_number
 * @property string|null $email
 * @property string|null $message
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 * @property DateTime|null $deleted_at
 */
class HelpResource extends Model
{
    use SoftDeletes, Searchable;

    /**
     * @return BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return HasMany
     */
    public function helpresourcetypes()
    {
        return $this->hasMany(HelpResourceType::class, 'help_resource_id');
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'message' => $this->message
        ];
    }
}
