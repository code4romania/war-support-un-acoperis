<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class HelpRequestNote
 * @package App
 *
 * @property int $id
 * @property int $help_request_id
 * @property string $message
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 */
class HelpRequestNote extends Model
{
    /**
     * @return BelongsTo
     */
    public function helprequest()
    {
        return $this->belongsTo(HelpRequest::class);
    }
}
