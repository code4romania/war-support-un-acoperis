<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class HelpRequestAccommodationDetail
 * @package App
 *
 * @property int $id
 * @property int $help_request_id
 * @property string $clinic
 * @property int $country_id
 * @property string $city
 * @property int $guests_number
 * @property DateTime $start_date
 * @property DateTime|null $end_date
 * @property string|null $special_request
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 */
class HelpRequestAccommodationDetail extends Model
{
    /**
     * @return BelongsTo
     */
    public function helprequest()
    {
        return $this->belongsTo(HelpRequest::class);
    }

    /**
     * @return BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
