<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HelpRequestNote
 * @package App
 *
 * @property int $id
 * @property int $help_request_id
 * @property string $message
 * @property int|null $user_id
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 */
class HelpRequestNote extends Model
{
    use SoftDeletes;

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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
