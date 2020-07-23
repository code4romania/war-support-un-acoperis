<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class HelpRequest
 * @package App
 *
 * @property int $id
 * @property string $patient_full_name
 * @property string|null $patient_phone_number
 * @property string|null $patient_email
 * @property string|null $caretaker_full_name
 * @property string|null $caretaker_phone_number
 * @property string|null $caretaker_email
 * @property int $county_id
 * @property int $city_id
 * @property string|null $diagnostic
 * @property string|null $extra_details
 * @property string $status
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 */
class HelpRequest extends Model
{
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
        return $this->belongsTo(County::class);
    }

    /**
     * @return BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @return HasMany
     */
    public function helprequestnotes()
    {
        return $this->hasMany(HelpRequestNote::class);
    }

    /**
     * @return HasMany
     */
    public function helprequestsmsdetail()
    {
        return $this->hasMany(HelpRequestSmsDetails::class);
    }

    /**
     * @return HasMany
     */
    public function helprequestaccommodationdetail()
    {
        return $this->hasMany(HelpRequestAccommodationDetail::class);
    }

    /**
     * @return BelongsToMany
     */
    public function helptypes()
    {
        return $this->belongsToMany(HelpType::class, 'help_request_types')->withPivot(['approve_status', 'message']);
    }
}
