<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class HelpRequest
 * @package App
 *
 * @property int $id
 * @property string $patient_full_name
 * @property int|null $patient_phone_country_id
 * @property string|null $patient_phone_number
 * @property string|null $patient_email
 * @property string|null $caretaker_full_name
 * @property int|null $caretaker_phone_country_id
 * @property string|null $caretaker_phone_number
 * @property string|null $caretaker_email
 * @property int $county_id
 * @property string $city
 * @property string|null $diagnostic
 * @property string|null $extra_details
 * @property string $status
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 * @property DateTime|null $deleted_at
 */
class HelpRequest extends Model implements Auditable
{
    use SoftDeletes, Searchable;
    use \OwenIt\Auditing\Auditable;

    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'in-progress';
    const STATUS_COMPLETED = 'completed';

    /**
     * @return array
     */
    public static function statusList(): array
    {
        return [
            self::STATUS_NEW => __('Status New'),
            self::STATUS_IN_PROGRESS => __('Status In Progress'),
            self::STATUS_COMPLETED => __('Status Completed')
        ];
    }

    /**
     * @return BelongsTo
     */
    public function county()
    {
        return $this->belongsTo(UaRegion::class);
    }


    /**
     * @return HasMany
     */
    public function helprequestnotes()
    {
        return $this
            ->hasMany(Note::class, 'entity_id')
            ->where('notes.entity_type', '=', Note::TYPE_HELP_REQUEST);
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
            'name' => $this->patient_full_name,
            'description' => $this->caretaker_full_name,
            'additional_information' => $this->diagnostic
        ];
    }
}
