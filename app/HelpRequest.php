<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    // TODO: define status list, as constants
    const STATUS_NEW = 'new';

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
}
