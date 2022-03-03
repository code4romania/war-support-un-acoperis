<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class HelpRequest
 * @package App
 *
 * @property int $id
 * @property int user_id
 * @property int|null created_by
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
 * @property DateTime|null $approved_at
 */
class HelpRequest extends Model implements Auditable
{
    use SoftDeletes, Searchable;
    use \OwenIt\Auditing\Auditable;

    const STATUS_NEW = 'padding';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'fulfilled';
    const STATUS_PARTIAL_ALLOCATED = 'allocated';

//    public $casts = [
//        'known_languages' => 'json',
//        'with_peoples' => 'json',
//    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'approved_at'
    ];

    /**
     * @return array
     */
    public static function statusList(): array
    {
        return [
            self::STATUS_NEW => __('Status New'),
            self::STATUS_IN_PROGRESS => __('Status In Progress'),
            self::STATUS_COMPLETED => __('Status Completed'),
            self::STATUS_PARTIAL_ALLOCATED => __('Status Partial Allocated')
        ];
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function accommodation(): BelongsToMany
    {
        return $this->belongsToMany(Accommodation::class, 'allocations', 'help_request_id', 'accommodation_id');
    }

    public function isAllocated(): bool
    {
        return $this->accommodation()->exists();
    }


    public function county(): BelongsTo
    {
        return $this->belongsTo(UaRegion::class);
    }

    public function helprequestnotes(): HasMany
    {
        return $this
            ->hasMany(Note::class, 'entity_id')
            ->where('notes.entity_type', '=', Note::TYPE_HELP_REQUEST);
    }

    /**
     * @return BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

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
