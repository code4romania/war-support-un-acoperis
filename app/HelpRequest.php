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
 * @property int user_id
 * @property string $current_location
 * @property int $guests_number
 * @property string $known_languages
 * @property string|null $special_needs
 * @property string|null $with_peoples
 * @property string $status
 * @property string $more_details
 * @property bool $need_car
 * @property bool $need_special_transport
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

//    public $casts = [
//        'known_languages' => 'json',
//        'with_peoples' => 'json',
//    ];

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
