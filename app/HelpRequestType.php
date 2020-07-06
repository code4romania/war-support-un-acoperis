<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class HelpRequestType
 * @package App
 *
 * @property int $id
 * @property int $help_request_id
 * @property int $help_type_id
 * @property string|null $message
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 */
class HelpRequestType extends Model
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
    public function helptype()
    {
        return $this->belongsTo(HelpType::class);
    }
}
