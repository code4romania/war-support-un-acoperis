<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class HelpRequestSmsDetails
 * @package App
 *
 * @property int $id
 * @property int $help_request_id
 * @property float $amount
 * @property string|null $purpose
 * @property string|null $clinic
 * @property int $country_id
 * @property string $city
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 */
class HelpRequestSmsDetails extends Model
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
